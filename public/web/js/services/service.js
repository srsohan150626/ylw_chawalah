/*
 * Security contexts
 */
/*
 * Service settings
 */
var COYAmenus_settings = {
    "database_id": "5d2eb4b70f0d3174802f9dcd"
}
/*
 * Services
 */
var COYAmenus_MenuItems_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/MenuItems',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_Doha_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/Doha',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_ParisWines_update_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/ParisWines/{_id}',
    'dataType': 'json',
    'type': 'put',
    'contentType': 'application/json',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}",
            "Content-Type": "application/json"
        },
        "parameters": {},
        "body": {
            "acl": {
                "*": {
                    "write": true,
                    "read": true
                }
            }
        }
    }
});
var COYAmenus_Data_create_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/Data',
    'dataType': 'json',
    'type': 'post',
    'contentType': 'application/json',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}",
            "Content-Type": "application/json"
        },
        "parameters": {},
        "body": {
            "acl": {
                "*": {
                    "write": true,
                    "read": true
                }
            }
        }
    }
});
var COYAmenus_Paris_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/Paris',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_DohaCocktails_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/DohaCocktails',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_MykonosWines_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/MykonosWines',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_ParisCocktails_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/ParisCocktails',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_AuDhabiDrinks_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/AuDhabiDrinks',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_AbuDhabiCocktails_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/AbuDhabiCocktails',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_ParisWines_delete_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/ParisWines/{_id}',
    'dataType': 'json',
    'type': 'delete',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_Mykonos_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/Mykonos',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_DubaiDrinks_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/DubaiDrinks',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_DubaiCocktails_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/DubaiCocktails',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_LondonFood_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/LondonFood',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_ParisWines_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/ParisWines',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_ParisWines_create_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/ParisWines',
    'dataType': 'json',
    'type': 'post',
    'contentType': 'application/json',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}",
            "Content-Type": "application/json"
        },
        "parameters": {},
        "body": {
            "acl": {
                "*": {
                    "write": true,
                    "read": true
                }
            }
        }
    }
});
var COYAmenus_MykonosDrinks_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/MykonosDrinks',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_LondonCocktails_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/LondonCocktails',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_DohaDrinks_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/DohaDrinks',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_GstaadDrinks_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/GstaadDrinks',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_GstaadCocktails_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/GstaadCocktails',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_MykonosCocktails_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/MykonosCocktails',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_Dubai_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/Dubai',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_ParisTerrace_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/ParisTerrace',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_LondonDrinks_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/LondonDrinks',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_DubaiWine_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/DubaiWine',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_ParisDrinks_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/ParisDrinks',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});
var COYAmenus_Gstaad_query_service = new Apperyio.RestService({
    'url': 'https://api.appery.io/rest/1/db/collections/Gstaad',
    'dataType': 'json',
    'type': 'get',
    'serviceSettings': COYAmenus_settings
        ,
    'defaultRequest': {
        "headers": {
            "X-Appery-Database-Id": "{database_id}"
        },
        "parameters": {},
        "body": null
    }
});