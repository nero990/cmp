<?php

namespace App\Http\Controllers\Family;

use App\ChurchEngagement;
use App\Family;
use App\Http\Controllers\Controller;
use App\Http\Requests\Family\MemberRequest;
use App\Member;
use App\MemberRole;
use App\SacramentDetail;
use App\SacramentQuestion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{

    public function autoComplete(Request $request) {
        $term = $request->get('term');

        $members = Member::where('first_name', 'LIKE', "%{$term}%")
            ->orWhere('middle_name', 'LIKE', "%{$term}%")
            ->orWhere('last_name', 'LIKE', "%{$term}%")
            ->selectRaw("id AS value, CONCAT(first_name,' ', middle_name, ' ', last_name, ' (', occupation, ')') AS label ")
            ->take(10)->get();

        return response()->json($members);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param Family $family
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $age_group_list = Member::AGE_GROUP_LIST;
        $marital_status_list = Member::MARITAL_STATUS_LIST;
        $sacrament_question_list = SacramentQuestion::pluck('question', 'id');
        $church_engagement_list = ChurchEngagement::pluck('name', 'id');
        $member_role_list = MemberRole::notHead()->pluck('name', 'id');

        return view('admin.members.create', compact('family', 'age_group_list', 'marital_status_list', 'sacrament_question_list', 'church_engagement_list', 'member_role_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MemberRequest $request
     * @param Family $family
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(MemberRequest $request, Family $family)
    {
        return $this->save($request, $family);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return $this->edit($member, true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member $member
     * @param bool $disabled
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member, $disabled = false)
    {
        $age_group_list = Member::AGE_GROUP_LIST;
        $marital_status_list = Member::MARITAL_STATUS_LIST;
        $sacrament_question_list = SacramentQuestion::pluck('question', 'id');
        $church_engagement_list = ChurchEngagement::pluck('name', 'id');
        $member_role_list = MemberRole::notHead()->pluck('name', 'id');

        $member->load('role', 'sacrament_questions');
        return view('admin.members.edit', compact('member', 'age_group_list', 'marital_status_list', 'sacrament_question_list', 'church_engagement_list', 'member_role_list', 'disabled'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MemberRequest $request
     * @param  \App\Member $member
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(MemberRequest $request, Member $member)
    {
        return $this->save($request, null, $member);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }

    /**
     * @param MemberRequest $request
     * @param Family $family
     * @param null $member
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    private function save(MemberRequest $request, $family = null, $member = null)
    {
        $data = $request->all();
        if(isset($data['deceased']) && $data['deceased'] == '0'){
            $data['deceased_at'] = null;
        }


        if(isset($family) || (isset($member) && !$member->role->is_head)) $data['member_role_id'] = $data['family_role'];
        elseif(isset($data['member_role_id'])) unset($data['member_role_id']);

        $data['phones'] = array_map('trim', explode(',', $data['phones']));

        $sacrament_questions = [];
        SacramentQuestion::enabled()->pluck('id')->each(function ($id) use ($data, &$sacrament_questions) {
            if (isset($data["sacrament_question_{$id}"])) {
                $sacrament_questions[$id] = ['response' => $data["sacrament_question_{$id}"]];
            }
        });

        try {
            DB::beginTransaction();
            if(isset($member)) {
                $member->update($data);
                $family = $member->family;
                $message = "Member record updated.";
            }
            else {
                $member = $family->members()->create($data);
                $message = "New Member Created.";
            }

            if (isset($data['church_engagements']))
                $member->church_engagements()->sync($data['church_engagements']);

            if (!empty($sacrament_questions))
                $member->sacrament_questions()->sync($sacrament_questions);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            throw new \Exception($exception->getMessage());
        }

        flash()->success("Success! {$message}");
        return redirect()->route('families.show', ['family' => $family->id]);
    }
}
