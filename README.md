# Review plugin for WinterCMS

![Blocks Plugin](https://github.com/hounddd/wn-reviews-plugin/blob/main/.github/Review-plugin.png?raw=true)

Show reviews, ratings or testimonials of your customers. No other plugin dependency.

## Features
* Manage reviews from backend
* Frontend components to display reviews

## Installation
*Let assume you're in the root of your wintercms installation*

### Using composer
Just run this command
```bash
composer require hounddd/wn-reviews-plugin
```

### Clone
Clone this repo into your winter plugins folder.

```bash
cd plugins
mkdir hounddd && cd hounddd
git clone https://github.com/Hounddd/wn-reviews-plugin reviews
```

> **Note**:
> In both cases, run `php artisan winter:up` command to run plugin's migrations

## Components
This plugin offer 2 components also availables as page snippets for Winter.Page plugin.
* **`reviews`** display a paginated list of reviews
* **`reviewsSlider`** display reviews in a slider

### Show reviews with `reviews` component

```twig
title = "Our customers reviews"
url = "/reviews/:page?"
layout = "default"
is_hidden = 0

[reviews]
pageNumber = "{{ :page }}"
categoryFilter = "{{ :category }}"
reviewsPerPage = 10
noReviewsMessage = "No reviews found"
sortOrder = "rating desc"
==
<h1>What our customers say about us?</h1>
{% component 'reviews' %}
```
#### **`reviews` component  properties**

| Property | Type | Description |
| --- | --- | --- |
| `pageNumber` | String | Page parameter for pagination.<br>Default: `'{{ :page }}'` |
| `reviewsPerPage` | String | Numbre of reviews per page.<br>Default: `'10'` |
| `categoryFilter` | String | Either a category slug or the page parameter to use for filtering categories.<br>Default: `''` |
| `noReviewsMessage` | String | Default: the `lang.components.general.no_reviews_default` key for translation file in use |
| `sortOrder` | String | The sorting order to use.<br>Possibles values: <ul><li>title asc</li><li>title desc</li><li>created_at asc</li><li>created_at desc</li><li>updated_at asc</li><li>updated_at desc</li><li>rating asc</li><li>rating desc</li><li>random</li></ul><br>Default: `'created_at desc'` |
| `ratingDisplay` | String | Rating display type<br>Possibles values: <ul><li>none: rating is not displayed</li><li>stars: use stars</li><li>text: use text</li><li>both: use both stars and text</li></ul><br>Default:`'both'` |

### Show reviews with `reviewsSlider` component

By default, the component lets you choose between different types of slider:
 - Using **[Tiny Slider 2](https://github.com/ganlanyuan/tiny-slider)**
 - Using **Tailwind CSS & Alpine JS**.

```twig
[reviewsSlider]
sliderType = "tailwind_alpine"
noReviewsMessage = "No reviews found"
sortOrder = "rating desc"
==
<h1>What our customers say about us?</h1>
{% component 'reviewsSlider' %}
```
#### **`reviewsSlider` component  properties**

| Property | Type | Description |
| --- | --- | --- |
| `sliderType` | String | The slider type to render.<br>Possibles values<br>Possibles values:<ul><li>tailwind_alpine</li><li>tiny_slider</li></ul><br>Default: `'tiny_slider'` |
| `categoryFilter` | String | Either a category slug or the page parameter to use for filtering categories.<br>Default: `''` |
| `noReviewsMessage` | String | Default: the `lang.components.general.no_reviews_default` key for translation file in use |
| `sortOrder` | String | The sorting order to use.<br>Possibles values: <ul><li>title asc</li><li>title desc</li><li>created_at asc</li><li>created_at desc</li><li>updated_at asc</li><li>updated_at desc</li><li>rating asc</li><li>rating desc</li><li>random</li></ul><br>Default: `'created_at desc'` |
| `ratingDisplay` | String | Rating display type<br>Possibles values: <ul><li>none: rating is not displayed</li><li>stars: use stars</li><li>text: use text</li><li>both: use both stars and text</li></ul><br>Default:`'both'` |
| `showDots` | Boolean | Show dots navigation in review slider<br>Default: `0` |
| `showControls` | Boolean | Show control buttons in review slider<br>Default: `0` |
| `showCounter` | Boolean | Show a reviews counter<br>Default: `0` |
| `autoPlay` | String |The delay in seconds before the slider must show the next review.<br>Default: `'0'` (disabled) |
| `loadScripts` | Boolean | The required scripts must be loaded by the component.<br>Default: `1` |


Sliders make use of javascript to control the slides, the needed scripts will be loaded automatically if you set the `loadScripts` component property to `true`.

> **Note**:
> ⚠ As Tailwind is an utility CSS framework, it will not be loaded by the component.
> If you're using Tailwind CSS and Alpine JS slider, you may need to add the component's path to the `content` property of your theme's `tailwind.config.js` file.
> ```js
> module.exports = {
> content: [
>         // ...
>         './../../plugins/hounddd/reviews/components/**/*.htm',
>     ],
>     // ...
> }
> ```

## 🏆 Credits

Inspired by [Mja.Testimonials](https://github.com/MatissJanis/oc-testimonials) [VojtaSvoboda.Reviews plugin](https://github.com/vojtasvoboda/oc-reviews-plugin)

***
Make awesome sites with ❄ [WinterCMS](https://wintercms.com)!
