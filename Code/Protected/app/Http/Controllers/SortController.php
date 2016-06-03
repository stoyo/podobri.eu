<?php namespace Podobri\Http\Controllers;

use Carbon\Carbon;
use Podobri\Models\Problem;
use Podobri\Models\Solution;
use DB;

class SortController extends Controller {

    private $categories;
    private $rand_probs;

    public function __construct() {
        $this->categories = DB::table('categories')->orderBy('category_id', 'asc')->get();
        $this->rand_probs = Problem::where(function($query) {
                    return $query;
                })->get()->shuffle()->slice(0, 9);
    }

    public function getSortByCategory($query) {

        foreach ($this->categories as $category) {
            if ($query == $category->category_slug) {
                $query = $category->category_name;
            }
        }

        $problems = Problem::where('category', $query)->orderBy('created_at', 'desc')->paginate(10);

        Carbon::setLocale('bg');
        return view('problems.index')
                        ->with('categories', $this->categories)
                        ->with('rand_probs', $this->rand_probs)
                        ->with('problems', $problems)
                        ->with('title', $query . ' | Подобри')
                        ->with('description', 'Филтрирани резултати от системата на Подобри');
    }

    public function getSortByDate($query) {
        if ($query == 'asc' || $query == 'desc') {

            $problems = Problem::where(function($query) {
                        return $query;
                    })->orderBy('created_at', $query)->paginate(10);

            ($query == 'asc') ? $query = 'Първо добавени' : $query = 'Последно добавени';
        } elseif ($query == 'lastWeek') {

            $problems = Problem::where('created_at', '>=', Carbon::now()->subWeek())->orderBy('created_at', 'desc')->paginate(10);

            $query = 'От последната седмица';
        } else {
            abort(404);
        }

        Carbon::setLocale('bg');
        return view('problems.index')
                        ->with('categories', $this->categories)
                        ->with('rand_probs', $this->rand_probs)
                        ->with('problems', $problems)
                        ->with('title', $query . ' | Подобри')
                        ->with('description', 'Филтрирани резултати от системата на Подобри');
    }

    public function getSortByStatus($query) {
        if ($query == 'solved') {

            $problems = Problem::whereExists(function($query) {
                                $query->select(DB::raw('*'))
                                ->from('solutions')
                                ->whereRaw('solutions.problem_id = problems.id')
                                ->where('solutions.solution_condition', 2);
                            })
                            ->orderBy('created_at', 'DESC')->paginate(10);

            $query = 'Решени проблеми';
        } elseif ($query == 'pending') {

            $problems = Problem::whereExists(function($query) {
                                $query->select(DB::raw('*'))
                                ->from('solutions')
                                ->whereRaw('solutions.problem_id = problems.id')
                                ->where('solutions.solution_condition', 1);
                            })
                            ->orderBy('created_at', 'DESC')->paginate(10);

            $query = 'Чакащи потвърждение проблеми';
        } elseif ($query == 'unsolved') {

            $currentSolutions = Solution::lists('problem_id');

            $problems = Problem::whereNotIn('problems.id', $currentSolutions)->orderBy('created_at', 'DESC')->paginate(10);

            $query = 'Нерешени проблеми';
        } else {
            abort(404);
        }

        Carbon::setLocale('bg');
        return view('problems.index')
                        ->with('categories', $this->categories)
                        ->with('rand_probs', $this->rand_probs)
                        ->with('problems', $problems)
                        ->with('title', $query . ' | Подобри')
                        ->with('description', 'Филтрирани резултати от системата на Подобри');
    }

    public function getSortByCity($query) {

        if ($query == 'Dobrich') {
            $query = 'Добрич';
        }
        if ($query == 'Varna') {
            $query = 'Варна';
        }
        if ($query == 'Sofia') {
            $query = 'София';
        }

        $problems = Problem::where('location', 'LIKE', "%$query%")
                        ->orderBy('created_at', 'desc')->paginate(10);

        Carbon::setLocale('bg');
        return view('problems.index')
                        ->with('categories', $this->categories)
                        ->with('rand_probs', $this->rand_probs)
                        ->with('problems', $problems)
                        ->with('title', $query . ' | Подобри')
                        ->with('description', 'Филтрирани резултати от системата на Подобри');
    }

}
