# Helper Package for Laravel

A versatile Laravel helper package providing utilities for **file uploads**, **slug generation**, **JSON responses**, **database export**, **unit conversion**, and more. Designed to speed up development by providing ready-to-use helpers and traits.

---

## Table of Contents
- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
  - [Helper Class](#helper-class)
  - [AllTraits](#alltraits)
- [Traits Included](#traits-included)
- [Unit Conversion](#unit-conversion)
- [License](#license)

---

## Compatibility

This package is compatible with modern versions of Laravel and PHP:

Laravel: 9.x, 10.x, 11.x, and 12.x

PHP: 8.1 or higher

It leverages the latest features of PHP 8, including union types and improved type safety, and is fully compatible with Laravel’s service container, facades, and Eloquent ORM.

---

## Features
- File and image upload/delete in **public** or **storage**.
- Generate **unique slugs** for models.
- JSON responses for success, error, and paginated data.
- Export the full database with SQL file download.
- Apply filters and pagination to queries easily.
- Convert file paths to full URLs for API responses.
- Change model status or delete records with Livewire.
- Unit conversions: cm ↔ feet, kg ↔ lbs.
- Helper methods for testing and general utilities.

---

## Installation

Install via Composer:

```bash
  composer require alifahmmed/helpers-package:^1.1.0
```

Configuration

The package auto-registers the service provider and facade:

```bash

  'providers' => [
      AlifAhmmed\HelperPackage\HelperServiceProvider::class,
  ],

  'aliases' => [
      'Helper' => AlifAhmmed\HelperPackage\Helpers\Helper::class,
  ],
```
Usage

Helper Class

You can use the helper class directly for common tasks:
```bash

  use AlifAhmmed\HelperPackage\Helpers\Helper;

  // File upload
  $path = Helper::fileUpload($request->file('image'), 'posts', 'My Post Image');

  // File delete
  Helper::fileDelete('uploads/posts/my-post-image.jpg');

  // Generate unique slug
  $slug = Helper::makeSlug(Post::class, 'My Post Title');

  // JSON response
  return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);

  // JSON error response
  return Helper::jsonErrorResponse('Something went wrong', 400, ['field' => 'error']);

```
AllTraits

You can use AllTraits to include all package traits in any class:
```bash

  use AlifAhmmed\HelperPackage\Traits\AllTraits;

  class PostController extends Controller
  {
      use AllTraits;
  }
```
ApiResponse

```bash

  public function index()
  {
      $posts = Post::all();
      return $this->success('Posts fetched successfully', $posts);
  }

  public function show($id)
  {
      $post = Post::find($id);
      if (!$post) {
          return $this->error('Post not found', 404);
      }
      return $this->ok('Post fetched successfully', $post);
  }

  public function listWithPagination()
  {
      $posts = Post::paginate(10);
      return $this->pagination('Posts list', $posts);
  }

  public function customPaginationExample()
  {
      $posts = Post::paginate(5);
      return $this->successPagination(true, 'Data fetched', 200, $posts, true);
  }
```
DatabaseExportable
```bash

  public function export()
  {
      return $this->exportDatabase();
  }

```
FileManager

```bash

  // Upload files to public folder
  public function uploadFiles(Request $request)
  {
      $paths = $this->uploadToPublic($request->file('images'), 'posts');
      return response()->json($paths);
  }

  // Delete files from public folder and update DB
  public function deleteFiles(Post $post)
  {
      $this->deleteFromPublic($post, 'images');
  }

  // Upload files to storage folder
  public function uploadToStorageExample(Request $request)
  {
      $paths = $this->uploadToStorage($request->file('documents'), 'docs');
      return response()->json($paths);
  }

  // Update files in public folder (delete old + upload new)
  public function updateFiles(Post $post, Request $request)
  {
      $paths = $this->updateToPublic($post, 'images', $request->file('images'), 'posts');
      return response()->json($paths);
  }
```
HasFilter

```bash

  public function index(Request $request)
  {
      $query = Post::query();
      $query = $this->applyFilters($query, $request);
      $limit = $this->getLimit($request, 10);
      $posts = $query->paginate($limit);

      return response()->json($posts);
  }
```
ImagePathTrait

```bash

  public function show(Post $post)
  {
      $post->image_url = $this->fullImageUrl($post->image);
      return response()->json($post);
  }

  // Only convert for API routes
  public function showApi(Post $post)
  {
      $post->image_url = $this->fullImageUrlForApi($post->image);
      return response()->json($post);
  }
```
SlugGenerator

```bash

  $slug = $this->generateSlug(Post::class, 'slug', $request->title);
```
TestPerpose

```bash

  return $this->testPerpose();
```
Unit Conversion
```bash
  $this->cmToFeet(180);  // 5.9055
  $this->feetToCm(5.9);  // 179.83
  $this->kgToLbs(70);    // 154.32
  $this->lbsToKg(154);   // 69.85
```
License

MIT License © S M Alif Ahmmed

Contribution

Feel free to contribute by submitting issues or pull requests on GitHub.

