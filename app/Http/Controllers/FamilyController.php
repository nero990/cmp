<?php

namespace App\Http\Controllers;

use App\BccZone;
use App\ChurchEngagement;
use App\Family;
use App\Member;
use App\MemberRole;
use App\SacramentQuestion;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyController extends Controller
{
    private $rules = [
        'name' => 'required',
        'type' => 'required|in:1,2',
        'state' => 'nullable|exists:states,id',
        'card_status' => 'required|in:0,1,2',
        'bcc_zone' => 'required|exists:bcc_zones,id',

        // Member files (Family head)
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'nullable|email',
        'phones' => 'required',
        'gender' => 'required|in:M,F',
        'marital_status' => 'required|in:1,2,3,4,5,6',
        'age_group' => 'required|in:1,2,3,4,5,6,7,8',
        'church_engagements' => 'nullable|array|exists:church_engagements,id'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.families.index', ['families' => Family::with('head')->orderBy('name')->paginate(getPaginateSize())]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state_list = State::pluck('name', 'id');
        $bcc_zone_list = BccZone::pluck('name', 'id');
        $church_engagement_list = ChurchEngagement::pluck('name', 'id');
        $sacrament_question_list = SacramentQuestion::enabled()->pluck('question', 'id');
        $age_group_list = Member::AGE_GROUP_LIST;
        $marital_status_list = Member::MARITAL_STATUS_LIST;
        $card_status_list = Family::CARD_STATUS;

        return view('admin.families.create',
            compact('state_list', 'bcc_zone_list', 'church_engagement_list', 'sacrament_question_list',
                'age_group_list', 'marital_status_list', 'card_status_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $data = $request->all();
        $data['state_id'] = $data['state'];
        $data['bcc_zone_id'] = $data['bcc_zone'];
        $data['member_role_id'] = MemberRole::whereName('Head')->first()->id;
        $data['phones'] = explode(',', $data['phones']);
        $data['names_of_children'] = $data['children'];

        $sacrament_questions = [];
        SacramentQuestion::enabled()->pluck('id')->each(function ($id) use($data, &$sacrament_questions) {
            if(isset($data["sacrament_question_{$id}"])) {
                $sacrament_questions[$id] = ['response' => $data["sacrament_question_{$id}"]] ;
            }
        });

        try{
            DB::beginTransaction();
            $family = Family::create($data);
            $member = $family->members()->create($data);

            if(isset($data['church_engagements']) && is_array($data['church_engagements']))
                $member->church_engagements()->sync($data['church_engagements']);

            if(!empty($sacrament_questions))
                $member->sacrament_questions()->sync($sacrament_questions);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            throw new \Exception($exception->getMessage());
        }

        flash()->success("Success! Family Created (Family RegNo.: {$family->registration_number})");
        return redirect()->route('families.show', ['family' => $family->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        $family->load('members', 'head');
        return view('admin.families.show', compact('family'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        $state_list = State::pluck('name', 'id');
        $bcc_zone_list = BccZone::pluck('name', 'id');
        $card_status_list = Family::CARD_STATUS;


        $family->load('members', 'state', 'bcc_zone');

        $family_head = $family->head()->selectRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) AS name, id")->pluck('name', 'id');

        $members = $family->members()->selectRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) AS name, id")
            ->pluck('name', 'id')->toArray();

        dd($members);
        return view('admin.families.edit', compact('family', 'state_list', 'bcc_zone_list', 'card_status_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        //
    }
}
