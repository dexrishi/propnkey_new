<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlugList;
use App\Traits\LogsActivity;

class SlugListController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of slug lists
     */
    public function index()
    {
        $slugLists = SlugList::ordered()->paginate(20);
        return $this->viewWithRoute('admin.slug-list.index', compact('slugLists'));
    }

    /**
     * Show the form for creating a new slug list
     */
    public function create()
    {
        return $this->viewWithRoute('admin.slug-list.create');
    }

    /**
     * Store a newly created slug list
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255|unique:slug_list,slug',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string|max:500',
            'headline' => 'nullable|string|max:255',
            'heading_2' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'bottom_headline' => 'nullable|string|max:255',
            'bottom_description' => 'nullable|string',
            'faq_questions' => 'nullable|array',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers' => 'nullable|array',
            'faq_answers.*' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $data = $request->except(['faq_questions', 'faq_answers']);
        $data['faq_items'] = $this->buildFaqItems(
            $request->input('faq_questions', []),
            $request->input('faq_answers', [])
        );

        $slugList = SlugList::create($data);
        
        // Log the activity
        $this->logCreate($slugList);

        return redirect()->route('slug-lists.index')
            ->with('success', 'Slug list created successfully.');
    }

    /**
     * Display the specified slug list
     */
    public function show(SlugList $slugList)
    {
        return $this->viewWithRoute('admin.slug-list.show', compact('slugList'));
    }

    /**
     * Show the form for editing the specified slug list
     */
    public function edit(SlugList $slugList)
    {
        return $this->viewWithRoute('admin.slug-list.edit', compact('slugList'));
    }

    /**
     * Update the specified slug list
     */
    public function update(Request $request, SlugList $slugList)
    {
        $request->validate([
            'slug' => 'required|string|max:255|unique:slug_list,slug,' . $slugList->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string|max:500',
            'headline' => 'nullable|string|max:255',
            'heading_2' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'bottom_headline' => 'nullable|string|max:255',
            'bottom_description' => 'nullable|string',
            'faq_questions' => 'nullable|array',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers' => 'nullable|array',
            'faq_answers.*' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $data = $request->except(['faq_questions', 'faq_answers']);
        $data['faq_items'] = $this->buildFaqItems(
            $request->input('faq_questions', []),
            $request->input('faq_answers', [])
        );
        
        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($slugList);
        
        $slugList->update($data);
        
        // Log the activity
        $this->logUpdate($slugList, $oldAttributes);

        return redirect()->route('slug-lists.index')
            ->with('success', 'Slug list updated successfully.');
    }

    /**
     * Remove the specified slug list
     */
    public function destroy(SlugList $slugList)
    {
        // Log the activity before deletion
        $this->logDelete($slugList);
        
        $slugList->delete();

        return redirect()->route('slug-lists.index')
            ->with('success', 'Slug list deleted successfully.');
    }

    /**
     * Toggle active status
     */
    public function toggle(SlugList $slugList)
    {
        $slugList->update(['is_active' => !$slugList->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $slugList->is_active
        ]);
    }

    private function buildFaqItems(array $questions = [], array $answers = []): array
    {
        $faqItems = [];

        foreach ($questions as $index => $question) {
            $questionText = trim((string) $question);
            $answerText = trim((string) ($answers[$index] ?? ''));

            if ($questionText === '' || $answerText === '') {
                continue;
            }

            $faqItems[] = [
                'question' => $questionText,
                'answer' => $answerText,
            ];
        }

        return $faqItems;
    }
}