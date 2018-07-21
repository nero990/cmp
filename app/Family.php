<?php

namespace App;

use App\Custom\Traits\FileUpload;
use App\Custom\Traits\GlobalScopes;
use App\Events\UserCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Family extends Model implements AuditableContract
{
    use Auditable, GlobalScopes, FileUpload;

    protected static $required_headings = [
        'surname', 'first_name', 'no_of_children', 'names_of_children', 'address',
        'contact', 'alt', 'state', 'family', 'single', 'family_reg_number', 'file_id'
    ];

    protected $fillable = [
        'registration_number', 'name', 'type', 'names_of_children', 'state_id', 'address', 'card_status', 'bcc_zone_id'
    ];

    protected $casts = [
        'names_of_children' => 'array'
    ];

    const DONT_DISPLAY_AUDIT = ["id", "state_id", "bcc_zone_id", "number_of_children"];

    const CARD_STATUS = [
        "0" => "Not Paid",
        "1" => "Paid",
        "2" => "Collected"
    ];

    public static $willGenerateRegNumber = true;

    protected static function boot()
    {
        static::creating(function ($family) {
            if(static::$willGenerateRegNumber) {
                do{
                    $registration_number = Setting::get('fam_reg_num_prf') .date('y'). str_pad(rand(1,999999), "6", "0", 0);
                } while (static::whereRegistrationNumber($registration_number)->exists());

                $family->registration_number = $registration_number;
            }

        });

        static::saving(function ($family) {

            if($family->type == "2" || is_null($family->names_of_children) || !is_array($family->names_of_children)) $family->names_of_children = [];
        });

        parent::boot(); // TODO: Change the autogenerated stub
        
        static::created(function ($family) {
            event(new UserCreated($family));
        });

    }

    /**
     * {@inheritdoc}
     */
    public function transformAudit(array $data): array
    {
        if(!$state_list = Cache::get('state_list')){
            $state_list = State::pluck('name', 'id')->toArray();
             Cache::forever('state_list', $state_list);
        }

        $bcc_zone_list = Cache::remember('bcc_zone_list', 60, function() {
            return BccZone::pluck('name', 'id')->toArray();
        });

        if(Arr::has($data, 'new_values.state_id')) {
            if(Arr::has($data, 'old_values.state_id') && !empty($this->getOriginal('state_id')))
                $data['old_values']['state'] = $state_list[$this->getOriginal('state_id')];

            if(!empty($this->getAttribute('state_id')))
                $data['new_values']['state'] = $state_list[$this->getAttribute('state_id')];
        }

        if(Arr::has($data, 'new_values.bcc_zone_id')) {
            if(Arr::has($data, 'old_values.bcc_zone_id') && !empty($this->getOriginal('bcc_zone_id')))
                $data['old_values']['bcc_zone'] = $bcc_zone_list[$this->getOriginal('bcc_zone_id')];

            if(!empty($this->getAttribute('bcc_zone_id')))
                $data['new_values']['bcc_zone'] = $bcc_zone_list[$this->getAttribute('bcc_zone_id')];
        }

        return $data;
    }

    public function bcc_zone() {
        return $this->belongsTo(BccZone::class);
    }

    public function files() {
        return $this->belongsTo(File::class);
    }

    public function members() {
        return $this->hasMany(Member::class);
    }
    
    public function head() {
        return $this->hasOne(Member::class)->whereHas('role', function ($query) {
            $query->where('name', 'Head');
        });
    }

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function user() {
        return $this->morphOne(User::class, 'person');
    }

    public function scopeFamily($query) {
        return $query->whereType('1');
    }

    public function scopeIndividual($query) {
        return $query->whereType('2');
    }

    public static function auditTransformer($attribute, $modified) {

        $modified = auditableJsonToString("names_of_children", $attribute, $modified);

        $modified = auditableValueToText('type', static::class, $attribute, $modified);
        $modified = auditableValueToText('card_status', static::class, $attribute, $modified);
        $modified = auditableEmptyToNull($modified, $attribute, 'bcc_zone');

        return $modified;
    }

    public function getNumberOfChildrenAttribute() {
        return count($this->names_of_children) + $this->members()->whereHas('role', function($query) {
            $query->where('name', '<>', 'Head')
                ->where('name', '<>', 'Spouse');
            })->count();
    }

    public function getUsernameAttribute() {
        return $this->attributes['registration_number'];
    }

    public static function getTypeText($type) {
        switch ($type) {
            case "1" :
                return "Family";
            case "2" :
                return "Individual";
            default:
                return "";
        }
    }

    public function getTypeTextAttribute() {
        return static::getTypeText($this->attributes['type']);
    }

    public function setHead($familyHeadId) {
        if($current_family_head = $this->members->find($familyHeadId)) {
            $this->head->update([
                'member_role_id' => $current_family_head->member_role_id
            ]);

            $current_family_head->update([
                'member_role_id' => MemberRole::getHead()
            ]);
        }
    }

    public static function getCardStatusText($card_status) {
        return static::CARD_STATUS[$card_status];
    }

    public function getCardStatusTextAttribute() {
        return static::getCardStatusText($this->attributes['card_status']);
    }

    public function getHouseHoldAttribute() {
        return $this->members()->count() + count($this->names_of_children);
    }
}
