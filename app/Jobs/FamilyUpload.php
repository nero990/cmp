<?php

namespace App\Jobs;

use App\Family;
use App\MemberRole;
use App\State;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

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
        $states = State::pluck('id', 'name')->toArray();

        $this->families->each(function ($fam) use ($states) {

            $state = ucfirst(strtolower(trim($fam->state)));
            $type = (strtoupper($fam->family) == "Y") ? "1" : 2;

            try{
                $first_name = trim(ucfirst(strtolower($fam->first_name)));
                $last_name = trim(ucfirst(strtolower($fam->surname)));

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
                        'gender' => 'M',
                        'age_group' => '3',
                        'member_role_id' => $member_role_id,
                        'marital_status' => '2',
                    ]);

                    DB::commit();
                }

            } catch (\Exception $exception) {
                DB::rollback();

//                throw new \Exception($exception->getMessage());
            }
        });
    }
}
