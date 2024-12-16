<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Blog;
use App\Models\Category;

class BlogList extends Component
{
    use WithPagination;

    public $categories;
    public $selectedCategory = 'All';

    public function mount()
    {
        // Fetch categories from the database
        $this->categories = Category::pluck('category_name')->prepend('All');
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->resetPage();
    }

    public function render()
    {
        $query = Blog::query()->where('status', 'published');

        if ($this->selectedCategory !== 'All') {
            $query->whereHas('category', function ($q) {
                $q->where('category_name', $this->selectedCategory);
            });
        }

        $blogs = $query->paginate(6);

        return view('livewire.blog-list', [
            'blogs' => $blogs,
        ]);
    }
}
