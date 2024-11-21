<template>
  <div class="task-list">
    <!-- Search Bar and Header -->
    <div class="list-header">
      <input
        type="text"
        class="search-input"
        placeholder="Search list"
        v-model="searchQuery"
      />
      <div class="actions">
        <button class="action-btn">Create New Project</button>
      </div>
    </div>

    <!-- Task List Table -->
    <table class="task-table">
      <thead>
        <tr>
          <th><input type="checkbox" @change="selectAll" /></th>
          <th>Name</th>
          <th>Key</th>
          <th>Description</th>
          <th>Start Date</th>
          <th>Due Date</th>
          <th>Days Left</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(task, index) in filteredTasks" :key="task.id">
          <td><input type="checkbox" v-model="task.selected" /></td>
          <td>{{ task.name }}</td>
          <td>{{ `TBT-${task.id}` }}</td>
          <td>{{ task.description }}</td>
          <td>{{ formatDate(task.created_at) }}</td>
          <td>{{ task.duedate }}</td>
          <td :class="{ overdue: calculateDaysLeft(task.duedate) < 0 }">
            {{ calculateDaysLeft(task.duedate) }}
          </td>
          <td>
            <div class="dropdown">
              <button class="dots-btn" @click="toggleMenu(index)">⋮</button>
              <ul v-if="task.showMenu" class="dropdown-menu">
                <li @click="updateTask(task)">Update</li>
                <li @click="deleteTask(task)">Delete</li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      searchQuery: "",
      tasks: [], // This will hold data fetched from the API
    };
  },
  computed: {
    filteredTasks() {
      if (!this.searchQuery.trim()) return this.tasks;

      const query = this.searchQuery.toLowerCase();

      return this.tasks.filter((task) => {
        return (
          task.name.toLowerCase().includes(query) ||
          `TBT-${task.id}`.toLowerCase().includes(query) ||
          task.description.toLowerCase().includes(query)
        );
      });
    },
  },
  methods: {
    async fetchTasks() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/project");
        const projects = response.data.projects;

        // Map the API response to match the table's expected structure
        this.tasks = projects.map((project) => ({
          id: project.id,
          name: project.name,
          description: project.description,
          created_at: project.created_at,
          duedate: project.duedate,
          selected: false,
          showMenu: false,
        }));
      } catch (error) {
        console.error("Error fetching tasks:", error);
      }
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    },
    calculateDaysLeft(dueDate) {
      const due = new Date(dueDate);
      const today = new Date();
      const timeDiff = due - today;
      return Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
    },
    selectAll(event) {
      const isChecked = event.target.checked;
      this.tasks.forEach((task) => (task.selected = isChecked));
    },
    toggleMenu(index) {
      this.tasks.forEach((task, i) => {
        task.showMenu = i === index ? !task.showMenu : false;
      });
    },
    updateTask(task) {
      alert(`Update Task: ${task.name}`);
      task.showMenu = false;
    },
    deleteTask(task) {
      if (confirm(`Are you sure you want to delete "${task.name}"?`)) {
        this.tasks = this.tasks.filter((t) => t !== task);
      }
    },
  },
  mounted() {
    this.fetchTasks(); // Fetch tasks when the component is mounted
  },
};
</script>

<style scoped>
.task-list {
  font-family: Arial, sans-serif;
  padding: 1rem;
  background-color: #f8f9fb;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.list-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.search-input {
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  width: 50%;
}

.actions {
  display: flex;
  gap: 0.5rem;
}

.action-btn {
  background: #0078d4;
  color: white;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.875rem;
}

.action-btn:hover {
  background: #005ea6;
}

.task-table {
  width: 100%;
  border-collapse: collapse;
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.task-table th,
.task-table td {
  text-align: left;
  padding: 0.75rem;
  border-bottom: 1px solid #ddd;
}

.task-table th {
  background: #f5f5f5;
}

.task-table td:last-child {
  border-right: none;
}

.task-table tr:hover {
  background: #f0f8ff;
}

.overdue {
  color: red;
  font-weight: bold;
}

.dropdown {
  position: relative;
}

.dots-btn {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}

.dropdown-menu {
  position: absolute;
  right: 0;
  top: 100%;
  background: white;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  list-style: none;
  padding: 0.5rem 0;
  margin: 0;
  z-index: 1000;
}

.dropdown-menu li {
  padding: 0.5rem 1rem;
  cursor: pointer;
}

.dropdown-menu li:hover {
  background: #f0f8ff;
}
</style>
