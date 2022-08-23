<template>
    <!-- component -->
    <div
        class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans"
    >
        <div class="bg-white rounded shadow p-6 m-4 w-full w-3/4">
            <div class="mb-4">
                <h1 class="text-grey-darkest">Todo List</h1>
                <div class="flex mt-4">
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker"
                        placeholder="Add Todo"
                        v-model="newItem.name"
                        @keyup.enter="addNEwItem"
                    />
                    <div class="flex items-center items-start m-4">
                        <input
                            id="checkbox-1"
                            aria-describedby="checkbox-1"
                            type="checkbox"
                            class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded"
                            v-model="priority"
                        />
                        <label
                            for="checkbox-1"
                            class="text-sm ml-3 font-medium text-gray-900"
                            >Priority
                        </label>
                    </div>
                    <button
                        class="flex-no-shrink p-2 border-2 rounded text-teal border-teal hover:-translate-y-0.5 transition motion-reduce:hover:translate-y-0 motion-reduce:transition-none hover:bg-teal"
                        @click.prevent="addNEwItem"
                    >
                        Add
                    </button>
                </div>
            </div>
            <div>
                <div
                    v-for="todo in todos"
                    :key="todo.id"
                    class="flex mb-1 items-center"
                >
                    <!-- -->
                    <p
                        class="w-full text-grey-darkest"
                        :class="{
                            'line-through': todo.isExpired,
                            'text-red-500	': todo.isPriority,
                        }"
                    >
                        {{ todo.name }}
                    </p>
                    <button
                        class="border-2 border-transparent bg-yellow-500 ml-3 py-2 px-4 font-bold uppercase text-white rounded hover:-translate-y-0.5 transition motion-reduce:hover:translate-y-0 motion-reduce:transition-none hover:bg-red"
                        @click="toExpired(todo)"
                    >
                        Expired
                    </button>
                    <button
                        class="border-2 border-transparent bg-red-500 ml-3 py-2 px-4 font-bold uppercase text-white rounded hover:-translate-y-0.5 transition motion-reduce:hover:translate-y-0 motion-reduce:transition-none hover:bg-red"
                        @click="removeItem(todo.id)"
                    >
                        Remove
                    </button>
                </div>
                <p v-if="isEmptyTodo" class="w-full text-green">
                    There is no any todo here
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from "@vue/reactivity";
import { computed, onMounted } from "@vue/runtime-core";
import store from "@/store";

const priority = ref(false);

function toExpired(item) {
    item.isExpired = !item.isExpired;
}

function toPriority() {
    return priority.value;
}

const newItem = reactive({
    name: "",
    description: "",
    isExpired: false,
    isPriority: toPriority(),
});

const addNEwItem = () => {
    if (newItem.name.length) store.dispatch("newTodoItem", newItem);
    newItem.name = "";
    priority.value = false;
};

function removeItem(id) {
    if (confirm("Are you sure that you want to delete this item"))
        todos.value = todos.value.filter((todo) => todo.id !== id);
}

const isEmptyTodo = computed(() => todos.value.length === 0);

const todos = computed(() => store.getters.getTodos);
onMounted(() => store.dispatch("fetchTodos"));

</script>

<style scoped></style>
