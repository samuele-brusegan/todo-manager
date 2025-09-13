<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bytelab - Todos</title>
        <?php require COMMON_HTML_HEAD ?>
    </head>

    <style>
        .new-todo-form {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;

            & > form {
                display: flex;
                flex-direction: column;
                background: var(--background-color);
                padding: 20px;
                border-radius: 10px;
                position: relative;
            }
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>

    <body>
        <div class="container">
            <h1> Todos </h1>

            <div>
                <h3>Actions</h3>
                <a href="javascript:void(0)" class="btn btn-primary" id="add-new-todo"> Add new </a>
            </div>

            <div>
                <div class="new-todo-form" hidden>
                    <form action="javascript:void(0)">
                        <img src="<?=URL_PATH?>/svg/close.svg" class="icon close-btn" style="aspect-ratio: 1; width: 20px">
                        <h4>Add a new ToDo</h4>
                        <input    class="form-control mb-2" type="text" placeholder="Title"       required>
                        <textarea class="form-control mb-2"             placeholder="Description" required></textarea>
                        <input    class="form-control mb-2" type="date" placeholder="Due date"    required>
                        <button type="submit" class="btn btn-primary"> Add </button>
                    </form>
                </div>
            </div>

            <h3>La mia lista di cose da fare</h3>
            <div class="todo-list">
                <!-- Sample todo items -->
                <todo-item due-date="13/09/2025" title="Imparare i Web Components"    completed ></todo-item>
                <todo-item due-date="14/09/2025" title="Costruire un componente ToDo"           ></todo-item>
                <todo-item due-date="15/09/2025" title="Condividere il mio lavoro con gli amici"></todo-item>
            </div>
        </div>
    </body>

    <script>
        let btnAdd = document.getElementById("add-new-todo");
		let newTodoForm = document.querySelector(".new-todo-form");
		btnAdd.addEventListener("click", () => {
			newTodoForm.hidden = false;
        })

        let allCloseBtns = document.querySelectorAll(".close-btn");
		allCloseBtns.forEach(btn => {
			btn.addEventListener("click", () => {
				newTodoForm.hidden = true;
            })
        })
    </script>

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
