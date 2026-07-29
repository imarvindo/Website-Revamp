---
name: ACF Free Repeater Limitation
description: ACF Free does not support Repeater fields — workaround using native PHP arrays in post meta
---

# ACF Free — No Repeater Field Support

## The Rule
Never use `update_field()` or `get_field()` for array/repeater data when only ACF Free is installed. It stores the row count as an integer but cannot expand sub-fields on read.

**Why:** ACF Repeater is an ACF Pro feature. The free plugin (v6.x) accepts the data silently but returns the raw count integer on `get_field()`, causing `foreach` to silently skip.

## How to Apply
Store arrays as native PHP arrays via `update_post_meta()` — WordPress serialises them automatically:

```php
// WRITE (seed script)
update_post_meta($post_id, 'svc_faqs', $array); // WordPress serialises

// READ (template)
$faqs = get_post_meta(get_the_ID(), 'svc_faqs', true) ?: [];
foreach ($faqs as $faq) { ... }
```

Meta keys used in seo-ae theme:
- `svc_benefits` — array of ['benefit'=>'...']
- `svc_process` — array of ['step_title'=>'...', 'step_desc'=>'...']
- `svc_faqs` — array of ['question'=>'...', 'answer'=>'...']
- `svc_technologies` — array of ['tech_name'=>'...']
- `svc_related` — array of post IDs

## Avoid JSON Encoding Too
`json_encode()` with HTML content in meta values can corrupt on retrieval due to charset mismatches. PHP arrays via `update_post_meta()` are always safe.

## Scalar ACF fields still work
Simple text fields (`get_field('short_description')`) work fine in ACF Free. Only repeaters are broken.
