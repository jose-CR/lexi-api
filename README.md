### Lexi API

<div align="center">
  <img src="https://img.shields.io/badge/php-%23777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Badge">
  <img src="https://img.shields.io/badge/postgres-%23316192?style=for-the-badge&logo=postgresql&logoColor=white" alt="Postgres Badge">
  <img src="https://img.shields.io/badge/laravel-%23FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Badge">
  <img src="https://img.shields.io/badge/livewire-%234e56a6?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire Badge">
</div>

## Introduccion Lexi API
Esta api esta basada para interactuar con diferentes palabras en diferentes idiomas al español, mas adelante se integraran mas idiomas, por ahora solo esta el ingles

## Paquetes Utilizados

1. [Laravel Breeze](https://github.com/laravel/breeze)
2. [Tailwind CSS](https://tailwindcss.com/)
3. [Laravel Schema Rules](https://github.com/laracraft-tech/laravel-schema-rules)

## Tabla de contenido

### Category

1. [Introduccion](#introducion-category)
2. [Rutas](#rutas-category)
3. [Includes](#includes-category)
4. [Creacion](#creacion-category)
5. [Editar](#editar-category)
6. [Borrar](#borrar-category)

### Sub Category

1. [Introducion](#introducion-sub-category)
2. [Rutas](#rutas-sub-category)
3. [Includes](#includes-sub-category)
4. [Creacion](#creacion-sub-category)
5. [Editar](#editar-sub-category)
6. [Borrar](#borrar-sub-category)

### Word

1. [Introducion](#introducion-word)
2. [Rutas](#rutas-word)
3. [Includes](#includes-word)
4. [Creacion](#creacion-word)
5. [Editar](#editar-word)
6. [Borrar](#borrar-word)

## Categoría

La introducción para la categoría es un modelo que solo tiene un campo llamado "category".

## Rutas
Las rutas para cada método son las siguientes:
- **GET**: `http://localhost:8000/api/v1/categories`
- **POST**: `http://localhost:8000/api/v1/categories`
- **PUT**: `http://localhost:8000/api/v1/categories/7`
- **DELETE**: `http://localhost:8000/api/v1/categories/7`

## Includes
En este modelo hay un include que permite mostrar todas las subcategorías que pertenecen a cada categoría:

- URL: http://localhost:8000/api/v1/categories?includeSubCategories=true

Para hacerlo más cómodo:

| Parámetro           | Valor  |
|---------------------|--------|
| includeSubCategories | True   |

## Creación
Para crear una nueva categoría utilizando Postman o Thunder Client:

```json
{
  "category": "sueco"
}
```

Luego verá este tipo de mensaje:

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ Se ha creado una nueva categoría correctamente.",
  "data": {
    "id": 6,
    "category": "sueco"
  }
}
```

## Edición
Para editar el campo de categoría, simplemente realice la misma acción que en la creación, ya que solo tiene un campo:

```json
{
  "category": "aleman"
}
```

Luego verá este tipo de mensaje:

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ Categoría actualizada correctamente.",
  "data": {
    "id": 7,
    "category": "aleman"
  }
}
```

## Eliminación
Para eliminar, solo necesita pasar el ID de la categoría y verá este mensaje:

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ La categoría se ha eliminado exitosamente.",
  "data": {
    "id": 7,
    "category": "aleman"
  }
}
```

## Subcategoría

El modelo de subcategoría pertenece a varias categorías y contiene varias palabras que pertenecen a diferentes subcategorías. Aunque tiene más campos, solo rellenaremos los campos primarios, no los que pertenecen a las palabras.

## Rutas
Las rutas para cada método son las siguientes:
- **GET**: `http://localhost:8000/api/v1/subcategories`
- **POST**: `http://localhost:8000/api/v1/subcategories`
- **PATCH**: `http://localhost:8000/api/v1/subcategories/7`
- **DELETE**: `http://localhost:8000/api/v1/categories/7`

## Includes
Este modelo incluye la funcionalidad para listar todas las subcategorías pertenecientes a cada categoría:

- `http://localhost:8000/api/v1/subcategories?includeWords=true`

Para hacerlo más cómodo, se puede incluir como una tabla:

| Parámetro     | Valor |
|---------------|-------|
| includeWords  | True  |

## Creación
Para crear una nueva subcategoría usando herramientas como Postman o ThunderClient, se deben proporcionar los siguientes campos. Además, puedes editar el ID o la subcategoría por separado si es necesario:

```json
{
  "categoryId": 8,
  "subCategory": "adjetivo"
}
```

Al completar la creación, verás un mensaje como el siguiente:

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ Se ha creado una nueva subcategoría correctamente.",
  "data": {
    "id": 35,
    "categoryId": 8,
    "subCategory": "adjetivo"
  }
}
```

## Edición
Para editar el campo de la subcategoría, simplemente realiza la misma acción que en la creación, o edita uno de los dos campos si es necesario:

```json
{
  "categoryId": 6
}
```

Después, verás un mensaje como este:

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ Categoría actualizada correctamente.",
  "data": {
    "id": 6,
    "category": "aleman"
  }
}
```

## Eliminación
Para eliminar, solo necesitas pasar el ID de la subcategoría y verás este mensaje:

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ La subcategoría se ha eliminado exitosamente.",
  "data": {
    "id": 35,
    "categoryId": 8,
    "subCategory": "adjetivo"
  }
}
```

## Words

El modelo de Word pertenece a varias subcategorías y tiene diferentes campos que se pueden completar.

## Rutas
Las rutas para cada método son las siguientes:
- **GET**: `http://localhost:8000/api/v1/words`
- **POST**: `http://localhost:8000/api/v1/words`
- **POST Bulk**: `http://localhost:8000/api/v1/words/bulk/`
- **PATCH**: `http://localhost:8000/api/v1/words/15`
- **DELETE**: `http://localhost:8000/api/v1/words/15`

## Creación
Para crear una nueva palabra usando Postman o Thunder Client, utiliza el siguiente formato. Puedes editar el ID o la subcategoría si es necesario:

```json
{
  "subCategoryId": 2,
  "letter": "a",
  "word": "apple",
  "definition": "manzana, verde",
  "sentence": "I ate an apple yesterday",
  "spanishSentence": "comí una manzana ayer"
}
```

Al completar la creación, verás un mensaje como el siguiente:

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ Se ha creado una nueva palabra correctamente.",
  "data": {
    "id": 303,
    "subCategoryId": 2,
    "letter": "a",
    "word": "apple",
    "definition": "manzana, verde",
    "sentence": "I ate an apple yesterday",
    "spanishSentence": "comí una manzana ayer"
  }
}
```

## bulk creation
esta ruta  es lpara crear diferentes paralabras en en un slo json y es lo mismo como crear una palabra pero como un array de esta:

```json
[
  {
    "subCategoryId": 1,
    "letter": "a",
    "word": "ask",
    "definition": "preguntar",
    "sentence": "in the school i ask to my frinds about the homework.",
    "spanishSentence": "en la escuela le pregunte a mis amigos sobre la tarea."
  },
  {
    "subCategoryId": 6,
    "letter": "e",
    "word": "example",
    "definition": "ejemplo",
    "sentence": "today the teacher we show the example",
    "spanishSentence": "hoy el profesor nos mostro el ejemplo."
    }
]
```

y cuando se insetaron mstrara este mensaje

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ Palabras insertadas correctamente.",
  "inserted": 2
}
```

## Edición
Para editar los campos de una palabra, realiza la misma acción que en la creación o edita los campos que desees:

```json
{
  "letter": "m",
  "word": "monkey"
}
```

Después, verás un mensaje como este:

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ Palabra actualizada correctamente.",
  "data": {
    "id": 303,
    "subCategoryId": 2,
    "letter": "m",
    "word": "monkey",
    "definition": "manzana, verde",
    "sentence": "I ate an apple yesterday",
    "spanishSentence": "comí una manzana ayer"
  }
}
```

## Eliminación
Para eliminar una palabra, solo necesitas pasar el ID de la palabra y verás este mensaje:

```json
{
  "status": "success",
  "color": "green",
  "message": "✅ La palabra se ha eliminado exitosamente.",
  "data": {
    "id": 303,
    "subCategoryId": 2,
    "letter": "m",
    "word": "monkey",
    "definition": "manzana, verde",
    "sentence": "I ate an apple yesterday",
    "spanishSentence": "comí una manzana ayer"
  }
}
```

