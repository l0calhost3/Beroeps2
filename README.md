# Beroeps2

## Recepten en CRUD

De recepten worden opgeslagen in `dashboard/CRUD-DB.sqlite`. De verbinding staat in
`database.php`, zodat de website en het dashboard dezelfde database gebruiken.

Start het project lokaal vanuit deze map met:

```bash
php -S localhost:8000
```

Open daarna:

- Website: `http://localhost:8000/recepten.php`
- Dashboard: `http://localhost:8000/dashboard/`

Via het dashboard kun je recepten bekijken, toevoegen, wijzigen en verwijderen.
Ingrediënten en bereidingsstappen worden als losse regels opgeslagen.
