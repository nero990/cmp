<?php

namespace App\Jobs;

use App\Events\FileUploaded;
use App\Family;
use App\MemberRole;
use App\State;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FamilyUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $families;

    /**
     * Create a new job instance.
     *
     * @param $families
     */
    public function __construct($families)
    {
        $this->families = $families;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $result = [];
        $states = State::pluck('id', 'name')->toArray();

        $this->families->each(function ($fam) use ($states, &$result) {

            $state = ucfirst(strtolower(trim($fam->state)));
            $type = (strtoupper(trim($fam->family)) == "Y") ? "1" : "2";

            try{
                $first_name = trim(ucfirst(strtolower($fam->first_name)));
                $last_name = trim(ucfirst(strtolower($fam->surname)));
                $gender = "M";

                if(isset($fam->gender)) {
                    if(strtoupper(trim($fam->gender)) == "M" || strtoupper(trim($fam->gender)) == "MALE") {
                        $gender = "M";
                    } else {
                        $gender = "F";
                    }
                }

                if($fam->surname){
                    DB::beginTransaction();

                    $names_of_children = ucwords(strtolower(trim($fam->names_of_children)));

                    Family::$batched = true;
                    $family = Family::firstOrcreate([
                        'registration_number' => $fam->family_reg_number
                    ], [
                        'name' => "{$first_name} {$last_name}",
                        'type' => $type,
                        'names_of_children' => empty($names_of_children) ?  null : explode(',', $names_of_children),
                        'state_id' => isset($states[$state]) ? $states[$state] : null,
                        'address' => trim(ucwords(strtolower($fam->address))),
                    ]);

                    $phones = trim($fam->contact);
                    if(!empty(trim($fam->alt))) {
                        if($phones) $phones .= "," . trim($fam->alt);
                        else $phones = trim($fam->alt);
                    }
                    if(empty($phones)) $phones = null;

                    $member_role_id = ($family->wasRecentlyCreated) ? MemberRole::getHead() : MemberRole::getDependency();

                    $family->members()->create([
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'phones' => empty($phones) ? null : explode(',', $phones),
                        'gender' => $gender,
                        'age_group' => '3',
                        'member_role_id' => $member_role_id,
                        'marital_status' => '2',
                    ]);

                    DB::commit();

                    $result['success'][] = [
                        'message' => ($family->wasRecentlyCreated) ? "Family created ({$fam->family_reg_number})" : "Member created"
                    ];
                }

            } catch (\Exception $exception) {
                DB::rollback();

                $result['errors'][] = [
                    'family_registration_number' => $fam->family_reg_number,
                    'error_message' => $exception->getMessage()
                ];
            }
        });

        event(new FileUploaded($result));
    }
}
