@extends('dashboard.admin.layouts.app')
@section('page_title', 'Menu Management')

@section('css')
    {{-- Nestable2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css">
    <style>
        .dd-handle { background: #f8f9fa; border: 1px solid #dee2e6; padding: 10px 15px; border-radius: 4px; }
        .dd-placeholder { background: #f0f0f0; border: 1px dashed #ccc; }
        .dd-item > button { margin-top: 5px; }
    </style>
@endsection

@section('admin-content')
    @php
        $pageName = 'Menu Management';
        $pageName2 = 'Organize Your Menu';

        // Helper function to build the menu tree for rendering
        function buildMenuTree($pages, $parentId = 0) {
            $branch = [];
            foreach ($pages as $page) {
                if ($page->parent_id == $parentId) {
                    $children = buildMenuTree($pages, $page->id);
                    if ($children) {
                        $page->children = $children;
                    }
                    $branch[] = $page;
                }
            }
            return $branch;
        }

        $menuTree = buildMenuTree($menuPages);
    @endphp

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $pageName }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $pageName }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <form id="menu-form" action="{{ route('pages.menu.update', ['locale' => app()->getLocale()]) }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- Active Menu --}}
                        <div class="col-md-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Active Menu</h3>
                                </div>
                                <div class="card-body">
                                    <div class="dd" id="active-menu">
                                        <ol class="dd-list">
                                            @foreach ($menuTree as $page)
                                                @include('dashboard.admin.pages_menu.menu-item', ['page' => $page])
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Available Pages --}}
                        <div class="col-md-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Available Pages</h3>
                                </div>
                                <div class="card-body">
                                    <div class="dd" id="available-pages">
                                        <ol class="dd-list">
                                            @foreach ($notInMenuss as $page)
                                                <li class="dd-item" data-id="{{ $page->id }}">
                                                    <div class="dd-handle">{{ $page->title }}</div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="top_menu" id="top_menu_output">
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Save Menu</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('js')
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Nestable2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Nestable for both lists
            $('#active-menu').nestable({
                group: 1, // Both lists are in the same group to allow dragging between them
                maxDepth: 5
            });

            $('#available-pages').nestable({
                group: 1,
                maxDepth: 1 // Items from here can't have children until moved
            });

            // On form submission, serialize the active menu and update the hidden input
            $('#menu-form').on('submit', function(e) {
                // Get the structure of the active menu only
                var list = $('#active-menu').nestable('serialize');
                
                // Update the hidden input's value with the JSON string
                $('#top_menu_output').val(JSON.stringify(list));
            });
        });
    </script>
@endsection
