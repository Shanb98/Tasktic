<template>
    
    <div class="board-container">
        
      <!-- Render each column -->
      <div class="column" v-for="(column, colIndex) in boardColumns" :key="colIndex">
        <h3>{{ column.title }}</h3>
        <!-- Draggable container -->
        <draggable
          :list="column.tasks"
          :group="'shared'"
          @end="onTaskDrop"
          class="tasks"
        >
          <!-- Define item slot for draggable -->
          <template #item="{ element }">
            <div class="task-card">
              <h4>({{ element.id }}) {{ element.title }}</h4>
              <p>{{ column.title }}</p>
              <p>{{ element.description }}</p>
              <div class="task-footer">
                <span class="assignee">{{ element.assignee }}</span>
              </div>
            </div>
          </template>
        </draggable>
      </div>
    </div>
  </template>
  
  <script>
  import draggable from "vuedraggable";
  
  export default {
    components: {
      draggable,
    },
    data() {
      return {
        // Board columns with tasks
        boardColumns: [
          {
            title: "To Do",
            tasks: [
              { id: 1, title: "Flow Down", description: "", assignee: "Chameera" },
              { id: 2, title: "Check Single Answer Issue", description: "", assignee: "Chameera" },
            ],
          },
          {
            title: "Doing",
            tasks: [
              { id: 3, title: "Originator Backend", description: "", assignee: "Shan Basnayake" },
              { id: 4, title: "Documentation", description: "", assignee: "Chamya Shami" },
            ],
          },
          {
            title: "Test",
            tasks: [
              { id: 5, title: "Originator Backend Dev", description: "", assignee: "Shan Basnayake" },
              { id: 6, title: "Originator UI", description: "", assignee: "Chamya Shami" },
            ],
          },
          {
            title: "Done",
            tasks: [
              { id: 7, title: "Originator UI", description: "", assignee: "Chamya Shami" },
              { id: 8, title: "Retransmitter UI", description: "", assignee: "Chamya Shami" },
            ],
          },
        ],
      };
    },
    methods: {
      onTaskDrop(event) {
        console.log("Task dropped:", event);
      },
    },
  };
  </script>
  
  <style scoped>
.board-container {
  display: flex; /* Use flex for horizontal scrolling */
  gap: 1rem;
  padding: 1rem;
  background-color: #f5f5f5;
  overflow-x: auto; /* Enable horizontal scrolling */
}

@media (max-width: 1300px) {
  .board-container {
    display: grid;
    grid-template-columns: 1fr; /* Stack columns vertically */
    overflow-x: hidden; /* Disable horizontal scrolling */
  }
}

.column {
  flex: 0 0 300px; /* Fixed width for horizontal scroll */
  height: 75vh;
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 1rem;
  display: flex;
  flex-direction: column;
}
  
  .column {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 1rem;
    display: flex;
    flex-direction: column;
  }
  
  h3 {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 0.5rem;
  }
  
  .tasks {
    min-height: 200px;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .task-card {
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    cursor: grab;
  }
  
  h4 {
    font-size: 1rem;
    margin: 0;
  }
  
  p {
    font-size: 0.875rem;
    color: #555;
  }
  
  .task-footer {
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: #777;
  }
  
  .assignee {
    font-weight: bold;
    color: #0078d4;
  }
  </style>
  