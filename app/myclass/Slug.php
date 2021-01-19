<?php
namespace App\myclass;
use Illuminate\Support\Str;
use App\Products;
use App\Posts;
class Slug
{
    /**
     * @param $title
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function createSlug($title, $id = 0, $table='Products')
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id, $table);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new Exception('Can not create a unique slug');
    }
    /*
        get relate slug
    */
    protected function getRelatedSlugs($slug, $id = 0, $table='Products')
    {
        switch ($table) {
            case 'Posts':
                return Posts::select('slug')->where('slug', 'like', $slug.'%')
                    ->where('id', '<>', $id)
                    ->get();
                break;
            case 'Catrgory':
                return Catrgory::select('slug')->where('slug', 'like', $slug.'%')
                    ->where('id', '<>', $id)
                    ->get();
                break;
            case 'Tags':
                return Tags::select('slug')->where('slug', 'like', $slug.'%')
                    ->where('id', '<>', $id)
                    ->get();
                break;
            
            default:
                return Products::select('slug')->where('slug', 'like', $slug.'%')
                    ->where('id', '<>', $id)
                    ->get();
                break;
        }
        
    }




}