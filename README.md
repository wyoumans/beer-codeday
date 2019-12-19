# Beer CodeDay

Built on Laravel 6 & Vue 2

## Getting Started

### DB Setup

Run the migrations:
```
php artisan migrate
```

Populate the database from 3rd party sources:
(This command will be executed daily on production to keep the data fresh)
```
php artisan art fetch-data
```

### Assets

Install dependencies
```
composer install
npm install
```

Compile Assets
```
npm run dev
```

Watch Assets
```
npm run watch
```

Compile assets for deployment
```
npm run production
```

## Tests

Run all unit and feature tests locally
```
sh tests.sh
```

## API documentation

### Authentication

This API is open to the public without authentication.

### Beers

#### Get all beers

GET `/api/beers`

# GET parameters

`page` *optional*

# Responses

`200` success

# Sample response

```
{
    "data": [{
        "id": 1,
        "punk_id": 1,
        "name": "Buzz",
        "tagline": "A Real Bitter Experience.",
        "description": "A light, crisp and bitter IPA brewed with English and American hops. A small batch brewed only once.",
        "image_url": "https:\/\/images.punkapi.com\/v2\/keg.png",
        "abv": 4.5,
        "recipes": [{
            "id": 1,
            "edamam_id": "1ca6edf86437b485c63d4f02ab4836d7",
            "url": "http:\/\/www.seriouseats.com\/recipes\/2009\/01\/dinner-tonight-quick-tikka-masala-recipe.html",
            "label": "Dinner Tonight: Quick Tikka Masala Recipe",
            "source": "Serious Eats",
            "image_url": "https:\/\/www.edamam.com\/web-img\/80b\/80bee0722fe8dfaac16863fa139f2c1f.jpg",
            "share_url": "http:\/\/www.edamam.com\/recipe\/dinner-tonight-quick-tikka-masala-recipe-3cbf430db35f429e11f919e656e61c64\/spicy+chicken+tikka+masala"
        },

        ...

        ]
    }, {
        "id": 2,
        "punk_id": 2,
        "name": "Trashy Blonde",
        "tagline": "You Know You Shouldn't",
        "description": "A titillating, neurotic, peroxide punk of a Pale Ale. Combining attitude, style, substance, and a little bit of low self esteem for good measure; what would your mother say? The seductive lure of the sassy passion fruit hop proves too much to resist. All that is even before we get onto the fact that there are no additives, preservatives, pasteurization or strings attached. All wrapped up with the customary BrewDog bite and imaginative twist.",
        "image_url": "https:\/\/images.punkapi.com\/v2\/2.png",
        "abv": 4.1,
        "recipes": [{
            "id": 31,
            "edamam_id": "bcb5cdcd6c6af49cb962b8bf5b4ca278",
            "url": "http:\/\/www.bbcgoodfood.com\/recipes\/2406\/",
            "label": "Cooking Fresh Crab",
            "source": "BBC Good Food",
            "image_url": "https:\/\/www.edamam.com\/web-img\/1c9\/1c9eb4027e0facc4d6d68f92993e2b50.jpg",
            "share_url": "http:\/\/www.edamam.com\/recipe\/cooking-fresh-crab-4f6fae79288f8d27f75d9ebc2bab454c\/fresh+crab+with+lemon"
        },

        ...

        ]
    },

    ...

    ],
    "links": {
        "first": "http:\/\/local.beer.com\/api\/beers?page=1",
        "last": "http:\/\/local.beer.com\/api\/beers?page=22",
        "prev": null,
        "next": "http:\/\/local.beer.com\/api\/beers?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 22,
        "path": "http:\/\/local.beer.com\/api\/beers",
        "per_page": 15,
        "to": 15,
        "total": 325
    }
}
```

#### Get a single beer

GET to `/api/beers/{id}`

# GET parameters

`id` *required*

# Responses

`404` beer not found

`200` success

# Sample response

```
{
    "data": {
        "id": 1,
        "punk_id": 1,
        "name": "Buzz",
        "tagline": "A Real Bitter Experience.",
        "description": "A light, crisp and bitter IPA brewed with English and American hops. A small batch brewed only once.",
        "image_url": "https:\/\/images.punkapi.com\/v2\/keg.png",
        "abv": 4.5,
        "recipes": [{
            "id": 1,
            "edamam_id": "1ca6edf86437b485c63d4f02ab4836d7",
            "url": "http:\/\/www.seriouseats.com\/recipes\/2009\/01\/dinner-tonight-quick-tikka-masala-recipe.html",
            "label": "Dinner Tonight: Quick Tikka Masala Recipe",
            "source": "Serious Eats",
            "image_url": "https:\/\/www.edamam.com\/web-img\/80b\/80bee0722fe8dfaac16863fa139f2c1f.jpg",
            "share_url": "http:\/\/www.edamam.com\/recipe\/dinner-tonight-quick-tikka-masala-recipe-3cbf430db35f429e11f919e656e61c64\/spicy+chicken+tikka+masala"
        },

        ...

        ]
    }
}
```

#### Get a random beer

GET to `/api/beers/random`

# Responses

`200` success

# Sample response

```
{
    "data": {
        "id": 1,
        "punk_id": 1,
        "name": "Buzz",
        "tagline": "A Real Bitter Experience.",
        "description": "A light, crisp and bitter IPA brewed with English and American hops. A small batch brewed only once.",
        "image_url": "https:\/\/images.punkapi.com\/v2\/keg.png",
        "abv": 4.5,
        "recipes": [{
            "id": 1,
            "edamam_id": "1ca6edf86437b485c63d4f02ab4836d7",
            "url": "http:\/\/www.seriouseats.com\/recipes\/2009\/01\/dinner-tonight-quick-tikka-masala-recipe.html",
            "label": "Dinner Tonight: Quick Tikka Masala Recipe",
            "source": "Serious Eats",
            "image_url": "https:\/\/www.edamam.com\/web-img\/80b\/80bee0722fe8dfaac16863fa139f2c1f.jpg",
            "share_url": "http:\/\/www.edamam.com\/recipe\/dinner-tonight-quick-tikka-masala-recipe-3cbf430db35f429e11f919e656e61c64\/spicy+chicken+tikka+masala"
        },

        ...

        ]
    }
}
```

### Recipes

#### Get all recipes

GET `/api/recipes`

# GET parameters

`page` *optional*

# Responses

`200` success

# Sample response

```
{
    "data": [{
        "id": 1,
        "edamam_id": "1ca6edf86437b485c63d4f02ab4836d7",
        "url": "http:\/\/www.seriouseats.com\/recipes\/2009\/01\/dinner-tonight-quick-tikka-masala-recipe.html",
        "label": "Dinner Tonight: Quick Tikka Masala Recipe",
        "source": "Serious Eats",
        "image_url": "https:\/\/www.edamam.com\/web-img\/80b\/80bee0722fe8dfaac16863fa139f2c1f.jpg",
        "share_url": "http:\/\/www.edamam.com\/recipe\/dinner-tonight-quick-tikka-masala-recipe-3cbf430db35f429e11f919e656e61c64\/spicy+chicken+tikka+masala"
    }, {
        "id": 2,
        "edamam_id": "b60f0e3de54a513769d6d8f7dd62c38e",
        "url": "http:\/\/www.kitchendaily.com\/recipe\/chicken-tikka-masala",
        "label": "Chicken Tikka Masala",
        "source": "Kitchen Daily",
        "image_url": "https:\/\/www.edamam.com\/web-img\/1f8\/1f867c644064e38aa71c57284e9ac2b1.jpg",
        "share_url": "http:\/\/www.edamam.com\/recipe\/chicken-tikka-masala-8c73999f40911d7c076d1060114941b5\/spicy+chicken+tikka+masala"
    },

    ...

    ],
    "links": {
        "first": "http:\/\/local.beer.com\/api\/recipes?page=1",
        "last": "http:\/\/local.beer.com\/api\/recipes?page=10",
        "prev": null,
        "next": "http:\/\/local.beer.com\/api\/recipes?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 10,
        "path": "http:\/\/local.beer.com\/api\/recipes",
        "per_page": 15,
        "to": 15,
        "total": 147
    }
}
```

#### Get a single recipe

GET to `/api/recipes/{id}`

# GET parameters

`id` *required*

# Responses

`404` recipe not found

`200` success

# Sample response

```
{
    "data": {
        "id": 1,
        "edamam_id": "1ca6edf86437b485c63d4f02ab4836d7",
        "url": "http:\/\/www.seriouseats.com\/recipes\/2009\/01\/dinner-tonight-quick-tikka-masala-recipe.html",
        "label": "Dinner Tonight: Quick Tikka Masala Recipe",
        "source": "Serious Eats",
        "image_url": "https:\/\/www.edamam.com\/web-img\/80b\/80bee0722fe8dfaac16863fa139f2c1f.jpg",
        "share_url": "http:\/\/www.edamam.com\/recipe\/dinner-tonight-quick-tikka-masala-recipe-3cbf430db35f429e11f919e656e61c64\/spicy+chicken+tikka+masala"
    }
}
```
