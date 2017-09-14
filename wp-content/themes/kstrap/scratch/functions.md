#Example to add a custom post type
```
$book = new CustomPostType('Book');
$book->addTaxonomy('category');
$book->addTaxonomy('author');

$book->addMetaBox(
    'Book Info',
    array(
        'Year'               => 'text',
        'Genre'              => 'text',
        'Description'        => 'textarea',
        'Featured'           => 'boolean',
        'Favorite Cat Photo' => 'image',
        'Start Date'         => 'date'
    )
);

$book->addMetaBox(
    'Formatted Description',
    array(
        'html'        => 'wysiwyg'
    )
);

```
