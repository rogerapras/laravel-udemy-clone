<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\ICategory;
use App\Http\Resources\CategoryResource;


class CategoryRepository extends RepositoryAbstract implements ICategory
{
    
    public function entity()
    {
        return Category::class;
    }
    
    public function fetchAll()
    {
        $categories = Category::parents()
                        ->with(['children' => function($children){
                            $children->ordered();
                        }])
                        ->ordered()
                        ->get();
        
        return $categories;
    }
    
    public function findById($id)
    {
        $category = Category::find($id);
        return $category;
    }
    
    public function update(array $data, $id)
    {
        $category = Category::find($id)
                        ->update([
                            'name' => $data['name'],
                            'slug' => \Str::slug($data['name']),
                            'image' => $data['icon']
                        ]);

        return $category;

    }

    public function store(array $data)
    {
        $max_sort = Category::max('sortOrder');
        $category = Category::create([
                        'name' => $data['name'],
                        'slug' => \Str::slug($data['name']),
                        'sortOrder' => $max_sort+1,
                        'parent_id' => $data['parent'],
                        'image' => $data['icon']
                    ]);
        return $category;

    }



    public function findBySlug($slug)
    {
        $category = Category::where('slug', $slug)->with(['children', 'parent'])->first();
        return $category;
    }
    
    public function findCategoriesWithCourses()
    {
        $categories = Category::isChild()->has('courses')->orderBy('name')->get();
        return $categories;
    }

    public function orderCategories(array $data)
    {
        $order = 1;
        foreach($data as $category_level_1):
            $level1 = Category::find($category_level_1['id']);
            if($level1->courses->count() > 0):
                continue;
            endif;
                
            if($level1['id']){
                $level1->sortOrder = $order;
                $level1->parent_id = NULL;
                $level1->save();
                $order += 1;
            }
            if(isset($category_level_1['children'])):
                $children_level_1 = $category_level_1['children'];
                foreach($children_level_1 as $category_level_2):
                    $level2 = Category::find($category_level_2['id']);
                    if($level2['id']){
                        $level2->sortOrder = $order;
                        $level2->parent_id = $level1['id'];
                        $level2->save();
                        $order += 1;
                    }
                endforeach;
            endif;
        endforeach;
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(! $category->hasChildren()){
            $category->delete();
        }
    }
}