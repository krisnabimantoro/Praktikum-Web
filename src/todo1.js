const todoValue = document.getElementById("todoText");
const todoAlert = document.getElementById("Alert");
const listItems = document.getElementById("list-items");
const addUpdate = document.getElementById("AddUpdateClick");

let todo = JSON.parse(localStorage.getItem("todo-list"));
if (!todo) {
  todo = [];
}

function setLocalStorage() {
  localStorage.setItem("todo-list", JSON.stringify(todo));
}

function setAlertMessage(message) {
  todoAlert.removeAttribute("class");
  todoAlert.innerText = message;
  setTimeout(() => {
    todoAlert.classList.add("toggleMe");
  }, 1000);
}

function CreateToDoItems() {
  if (todoValue.value === "") {
    todoAlert.innerText = "Please enter your todo text!";
    todoValue.focus();
  } else {
    let IsPresent = false;
    todo.forEach((element) => {
      if (element.item == todoValue.value) {
        IsPresent = true;
      }
    });

    if (IsPresent) {
      setAlertMessage("This item already present in the list!");
      return;
    }

    let li = document.createElement("li");
    const todoItems = ` <div
    
    ondblclick="CompletedToDoItems(this)"
    class="w-[269.55px] p-3 mt-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <p  class=" font-normal text-gray-700 dark:text-gray-400">${todoValue.value}</p>
        <button
            type="button"
            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 me-2 mb-2 mt-3 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
            onclick="DeleteToDoItems(this)"
        >
            Delete
        </button>

        <button
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            onclick="UpdateToDoItems(this)"
        >
            Edit
        </button>
        </div>`;
    li.innerHTML = todoItems;
    listItems.appendChild(li);

    if (!todo) {
      todo = [];
    }
    let itemList = { item: todoValue.value, status: false };
    todo.push(itemList);
    setLocalStorage();
  }
  todoValue.value = "";
}
function DeleteToDoItems(e) {
  let deleteValue = e.parentElement.querySelector("p").innerText;

  if (confirm(`Are you sure you want to delete this ${deleteValue}?`)) {
    todo = todo.filter((item) => item.item !== deleteValue.trim());
    e.parentElement.remove();
    setLocalStorage();
  }
}

function UpdateToDoItems(e) {
  const todoDiv = e.parentElement.parentElement.querySelector("p");

  if (todoDiv.style.textDecoration === "") {
    todoValue.value = todoDiv.innerText;

    updateText = todoDiv;

    addUpdate.setAttribute("onclick", "UpdateOnSelectionItems()");

    todoValue.focus();
  }
}

function UpdateOnSelectionItems() {
  if (todoValue.value === "") {
    todoAlert.innerText = "Please enter your todo text!";
    todoValue.focus();
    return;
  }

  let isPresent = false;
  todo.forEach((element) => {
    if (element.item === todoValue.value) {
      isPresent = true;
    }
  });

  if (isPresent) {
    setAlertMessage("This item already exists in the list!");
    return;
  }

  todo.forEach((element) => {
    if (element.item === updateText.innerText.trim()) {
      element.item = todoValue.value; 
    }
  });

  setLocalStorage();

  updateText.innerText = todoValue.value;

  addUpdate.setAttribute("onclick", "CreateToDoItems()");
  addUpdate.innerText = "Add";
  todoValue.value = "";

}

function CompletedToDoItems(e) {
  const todoDiv = e.parentElement.querySelector("div");
  if (todoDiv.style.textDecoration === "") {
    todoDiv.style.textDecoration = "line-through";

    const deleteButton = e.parentElement.querySelector("button[onclick='DeleteToDoItems(this)']");
    const editButton = e.parentElement.querySelector("button[onclick='UpdateToDoItems(this)']");

    deleteButton.style.display = "none";
    editButton.style.display = "none";

    todo.forEach((element) => {
      if (todoDiv.innerText.trim() == element.item) {
        element.status = true;
      }
    });

    // Save updated todo list to local storage
    setLocalStorage();
  }
}

function ReadToDoItems() {
  todo.forEach((element) => {
    let li = document.createElement("li");
    let style = "";
    let hide = "";
    if (element.status) {
      style = "style='text-decoration: line-through'";
      hide = "hidden";
    }
    const todoItems = `

    
    <div ${style} ondblclick="CompletedToDoItems(this)" class="w-[269.55px] p-3 mt-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
      <p class="font-normal text-gray-700 dark:text-gray-400">${element.item}</p>
      <button
        type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 me-2 mb-2 mt-3 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 ${hide}"
        onclick="DeleteToDoItems(this)"
      >
        Delete
      </button>
      <button
        type="button"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 ${hide}"
        onclick="UpdateToDoItems(this)"
      >
        Edit
      </button>
    </div>`;

    li.innerHTML = todoItems;
    listItems.appendChild(li);
  });
}
ReadToDoItems();
