For each model (Client, Task, Lead, Time Log, Leave, and so on), repeat these three enhancements:

Form Requests. Make StoreXRequest and UpdateXRequest, move the rules in, set authorize(), use $request->validated(), add @error and old() to the forms.
Eager loading. Find the relationship names after $row-> inside each loop, put them in with(...) (or load(...) for a single model).
Seeding. Write a factory, add HasFactory to the model, and add a loop in DatabaseSeeder.