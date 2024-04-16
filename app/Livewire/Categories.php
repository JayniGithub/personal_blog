<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

use function Laravel\Prompts\alert;

class Categories extends Component
{
    public $category_name;
    public $selected_category_id;
    public $updateCategoryMode = false;

    public $subcategory_name;
    public $parent_category;
    public $selected_subcategory_id;
    public $updateSubCategoryMode = false;

    protected $listeners = [
        'resetModalForm'
    ];

    public function resetModalForm() {
        $this->category_name = null;
        $this->subcategory_name = null;
        $this->parent_category = null;
    }

    public function addCategory() {
        $this->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        $category = new Category();
        $category->category_name = $this->category_name;
        $saved = $category->save();

        if($saved) {
            $this->dispatch('hideCategoryModel');
            toastr()->success('New Category Has Been Added!!!');
        }
    }

    public function editCategory($id) {
        $category = Category::findOrFail($id);
        $this->selected_category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->updateCategoryMode = true;
        $this->dispatch('showCategoryModel');
    }

    public function updateCategory() {
        if($this->selected_category_id) {
            $this->validate([
                'category_name' => 'required|unique:categories,category_name'
            ]);

            $category = Category::findOrFail($this->selected_category_id);
            $category->category_name = $this->category_name;
            $updated = $category->update();

            if($updated) {
                $this->updateCategoryMode = false;
                $this->dispatch('hideCategoryModel');
                toastr()->success('Category Has Been Updated!!!');
            }
        }
    }

    public function addSubCategory() {
        $this->validate([
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name',
            'parent_category' => 'required'
        ]);

        $subcategory = new SubCategory();
        $subcategory->subcategory_name = $this->subcategory_name;
        $subcategory->parent_category = $this->parent_category;
        $subcategory->slug = Str::slug($this->subcategory_name);
        $saved = $subcategory->save();

        if ($saved) {
            $this->dispatch('hideSubCategoryModel');
            toastr()->success('New SubCategory Has Been Added!!!');
        }
    }

    public function editSubCategory($id) {
        $subcategory = SubCategory::findOrFail($id);
        $this->selected_subcategory_id = $subcategory->id;
        $this->subcategory_name = $subcategory->subcategory_name;
        $this->parent_category = $subcategory->parent_category;
        $this->updateSubCategoryMode = true;
        $this->dispatch('showSubCategoryModel');
    }

    public function updateSubCategory() {
        if ($this->selected_subcategory_id) {
            $this->validate([
                'subcategory_name' => 'required|unique:sub_categories,subcategory_name',
                'parent_category' => 'required'
            ]);

            $subcategory = SubCategory::findOrFail($this->selected_subcategory_id);
            $subcategory->subcategory_name = $this->subcategory_name;
            $subcategory->slug = Str::slug($this->subcategory_name);
            $subcategory->parent_category = $this->parent_category;
            $updated = $subcategory->update();

            if ($updated) {
                $this->updateSubCategoryMode = false;
                $this->dispatch('hideSubCategoryModel');
                toastr()->success('SubCategory Has Been Updated!!!');
            }
        }
    }

    public function render()
    {
        return view('livewire.categories', [
            'categories'=> Category::orderBy('ordering', 'asc')->get(),
            'subcategories' => SubCategory::orderBy('ordering', 'asc')->get()
        ]);
    }
}
