/**
 * Data models
 */
Apperyio.Entity = new Apperyio.EntityFactory({
    "menuItems": {
        "type": "object",
        "properties": {
            "image": {
                "type": "string"
            },
            "description": {
                "type": "string"
            },
            "language": {
                "type": "string"
            },
            "location": {
                "type": "string"
            },
            "order": {
                "type": "string"
            },
            "nutrition": {
                "type": "string"
            },
            "title": {
                "type": "string"
            },
            "section": {
                "type": "string"
            },
            "price": {
                "type": "string"
            }
        }
    },
    "String": {
        "type": "string"
    },
    "menuItemsArray": {
        "type": "array",
        "items": {
            "type": "menuItems"
        }
    },
    "Number": {
        "type": "number"
    },
    "selectedItemsArray": {
        "type": "array",
        "items": {
            "type": "string"
        }
    },
    "Boolean": {
        "type": "boolean"
    }
});
Apperyio.getModel = Apperyio.Entity.get.bind(Apperyio.Entity);
/**
 * Data storage
 */
Apperyio.storage = {
    "menuItemsArray": new $a.LocalStorage("menuItemsArray", "menuItemsArray"),
    "menuItems": new $a.LocalStorage("menuItems", "menuItems"),
    "MenuSection": new $a.LocalStorage("MenuSection", "String"),
    "MenuSection2": new $a.LocalStorage("MenuSection2", "String"),
    "MenuItemID": new $a.LocalStorage("MenuItemID", "String"),
    "Title": new $a.LocalStorage("Title", "String"),
    "Subtitle": new $a.LocalStorage("Subtitle", "String"),
    "Price": new $a.LocalStorage("Price", "String"),
    "MenuSection2French": new $a.LocalStorage("MenuSection2French", "String"),
    "Location": new $a.LocalStorage("Location", "String"),
    "Price2": new $a.LocalStorage("Price2", "String"),
    "selectedItems": new $a.LocalStorage("selectedItems", "selectedItemsArray"),
    "selectedItemsChose": new $a.LocalStorage("selectedItemsChose", "String")
};