<?php
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bytelab - Todos</title>
        <?php require COMMON_HTML_HEAD ?>
    </head>
    <style>
    
        
    </style>
    <body>
        <div class="container">
            <h1> Todos </h1>
            
            <h3>La mia lista di cose da fare</h3>
            <div class="todo-list">


                <todo-item due-date="13/09/2025" title="Imparare i Web Components"    completed ></todo-item>
                <todo-item due-date="14/09/2025" title="Costruire un componente ToDo"           ></todo-item>
                <todo-item due-date="15/09/2025" title="Condividere il mio lavoro con gli amici"></todo-item>

                
            </div>
            
        </div>
    </body>
    <script>
        const db = new LocalDatabase("TaskDB", 1);

        function printTasks(tasks) {
            let list = document.querySelector(".todo-list");
			list.innerHTML = '';
			
			tasks.forEach(task => {
				
				if (task.hasOwnProperty("task")) {
                    let todoItem = document.createElement("todo-item");
                    
                    todoItem.setAttribute("title"      , task.task.title);
                    todoItem.setAttribute("description", task.task.description);
					todoItem.setAttribute("dueDate"    , task.task.dueDate);
					if (task.task.isCompleted) {
						todoItem.setAttribute("completed"  , "");
                    }
					list.appendChild(todoItem);
					
				}
				
            })
        }

        /*async function runExample() {
            try {
                // 1. Apri il database e crea l'object store
                await db.open("tasks", "id");

                // 2. Aggiungi un nuovo task
                const newTask = { task: new Task("Imparare IndexedDB", "",  "", false) };
                await db.push("tasks", newTask);
                console.log("Task aggiunto con successo!");

                // 3. Recupera tutti i task
                const allTasks = await db.getAll("tasks");
                console.log("Tutti i tasks:", allTasks);
                printTasks(allTasks)

                // 4. Aggiorna un task
                // const taskToUpdate = { id: 1, task: new Task("Completare la classe LocalDatabase", "",  "", true) };
                // await db.put("tasks", taskToUpdate);
                // console.log("Task aggiornato con successo!");

                // 5. Recupera il task aggiornato per verificarlo
                // const updatedTask = await db.get("tasks", 1);
                // console.log("Task aggiornato:", updatedTask);
                //
                // // 6. Cancella un task
                // await db.delete("tasks", 1);
                // console.log("Task cancellato con successo!");

            } catch (error) {
                console.error("Si è verificato un errore:\n\t", error);
            }
        }*/
        
        async function loadTasks() {
			try {
				// 1. Apri il database e crea l'object store
				await db.open("tasks", "id");
				let allTasks = await db.getAll("tasks");
				console.log("Tutti i tasks:", allTasks);
				printTasks(allTasks)
			} catch (error) {
				console.error("Si è verificato un errore:\n\t", error);
			}
		}
		
		loadTasks()
    </script>
</html>
