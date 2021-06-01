import json
import os
import mysql.connector
from mysql.connector import Error

# -- INSERT INTO User (name, description, email, password)  VALUES ("Usuario Prueba", "Este es un usuario de prueba", "seesga97@gmail.com", "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8")

# -- INSERT INTO Recipe (author_id, name, description) VALUES (1, "Falafel", "Learn how to make falafel with this easy homemade falafel recipe.  It’s bursting with zesty fresh fresh flavors, lightly pan-fried (instead of deep-fried), and perfect for falafel wraps, salads and other favorite dishes.")

# -- INSERT INTO Ingredient (recipe_id, name, quantity, unit) VALUES (1, "Chickpeas", "15", "ounce")
# -- INSERT INTO Ingredient (recipe_id, name, quantity, unit) VALUES (1, "Parsley leaves", "1", "cup")
# -- INSERT INTO Ingredient (recipe_id, name, quantity, unit) VALUES (1, "Cilantro leaves", "1", "cup")
# -- INSERT INTO Ingredient (recipe_id, name, quantity, unit) VALUES (1, "Flour", "1/3", "cup")

insert_query = "INSERT INTO {} ({}) VALUES ({})"

user_cols = ["name", "description", "email", "password"]
recipe_cols = ["author_id", "name", "description"]
ingredient_cols = ["recipe_id", "name", "quantity", "unit"]
step_cols = ["recipe_id", "description", "image_url"]
rating_cols = ["recipe_id", "value", "description"]


def create_connection():
    connection = None
    try:
        connection = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd=os.environ["MYSQL_ROOT_PASSWORD"],
            database=os.environ["MYSQL_DATABASE"]
        )
        print("Connection to MySQL DB successful")
    except Error as e:
        print(f"The error '{e}' occurred")

    return connection


def get_json_objects(filename):
    f = open(filename, 'r')
    return json.load(f)


def get_column_values(object, columns):
    values = []
    for col in columns:
        if col not in object.keys():
            continue
        if isinstance(object[col], str):
            values.append('"' + object[col] + '"')
        else:
            values.append(str(object[col]))
    return values


def insert_object(db, table, object, columns, parent_id = None, execute = False):
    values = get_column_values(object, columns)
    if parent_id:
        values.insert(0, str(parent_id))
    query = insert_query.format(table, ','.join(columns), ','.join(values))

    print(query)

    if execute:
        cursor = db.cursor()
        cursor.execute(query)
        db.commit()
        return cursor.lastrowid

    return -1

if __name__ == "__main__":
    users = get_json_objects('recipes.json')
    db = create_connection()

    for user in users:
        user_id = insert_object(db, 'User', user, user_cols, None, True)
        print('User id:', user_id)
        for recipe in user['recipes']:
            recipe_id = insert_object(db, 'Recipe', recipe, recipe_cols, user_id, True)
            print('Recipe id:', recipe_id)
            for ingredient in recipe['ingredients']:
                ingredient_id = insert_object(db, 'Ingredient', ingredient, ingredient_cols, recipe_id, True)
                print('Ingredient id:', ingredient_id)
            for step in recipe['steps']:
                step_id = insert_object(db, 'Step', step, step_cols, recipe_id, True)
                print('Step id:', step_id)
            for rating in recipe['ratings']:
                rating_id = insert_object(db, 'Rating', rating, rating_cols, recipe_id, True)
                print('Rating id:', rating_id)
