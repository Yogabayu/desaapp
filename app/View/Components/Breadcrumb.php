<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = $this->generateBreadcrumbs();
    }

    public function render()
    {
        return view('components.breadcrumb');
    }

    private function generateBreadcrumbs()
    {
        $breadcrumbs = [];
        $segments = request()->segments();
        $url = '';

        // Jika di area admin, mulai dengan Dashboard
        if ($segments[0] === 'admin' && count($segments) > 1) {
            $breadcrumbs[] = [
                'name' => 'Dashboard',
                'url' => route('admin.dashboard')
            ];
        }

        foreach ($segments as $segment) {
            $url .= '/'.$segment;
            if ($segment !== 'admin' || count($segments) === 1) {
                $breadcrumbs[] = [
                    'name' => breadcrumb_name($segment),
                    'url' => $url
                ];
            }
        }

        return $breadcrumbs;
    }
}