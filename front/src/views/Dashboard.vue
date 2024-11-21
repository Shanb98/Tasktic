<template>
    <div class="app-container">
      <!-- Sidebar -->
      <aside
        class="navigation-drawer"
        :class="{ collapsed: isDrawerCollapsed }"
      >
        <div class="drawer-header">
          <h2 class="logo" v-if="!isDrawerCollapsed">My App</h2>
        </div>
        <ul class="menu-list" v-show="!isDrawerCollapsed">
          <li
            v-for="item in menuItems"
            :key="item.name"
            :class="{ active: item.name === selectedMenu }"
            @click="selectMenu(item)"
          >
            {{ item.label }}
          </li>
        </ul>
        <!-- Toggle Button -->
        <button class="drawer-toggle" @click="toggleDrawer">
          <span v-if="isDrawerCollapsed">☰</span>
          <span v-else>✖</span>
        </button>
      </aside>
  
      <!-- Main Content -->
      <div class="main-content">
        <header class="top-bar">
          <h1>{{ currentPageTitle }}</h1>
        </header>
        <section class="content">
          <component :is="currentComponent" />
        </section>
      </div>
    </div>
  </template>
  
  <script>
  import Dashboard from "../components/Dashboard.vue";
  import Projects from "../components/Projects.vue"
  export default {
    data() {
      return {
        menuItems: [
          { name: "Dashboard", label: "Dashboard", component: "Dashboard" },
          { name: "projects", label: "Projects", component: "Projects" },
          { name: "Tasks", label: "Tasks", component: "Tasks" },
          { name: "users", label: "Users", component: "Users" },
        ],
        selectedMenu: "my-files", // Default selection
        isDrawerCollapsed: false, // Manage the drawer state
      };
    },
    components: {
      Dashboard,
      Projects
      // Add other components as needed
    },
    computed: {
      currentPageTitle() {
        const current = this.menuItems.find((item) => item.name === this.selectedMenu);
        return current ? current.label : "My App";
      },
      currentComponent() {
        const current = this.menuItems.find((item) => item.name === this.selectedMenu);
        return current ? current.component : null;
      },
    },
    mounted() {
      this.selectMenu(this.menuItems[0]); // Default to "My Files" on mount
      this.checkWindowSize(); // Set the drawer state based on the initial screen width
      window.addEventListener("resize", this.checkWindowSize);
    },
    beforeUnmount() {
      window.removeEventListener("resize", this.checkWindowSize);
    },
    methods: {
      selectMenu(item) {
        this.selectedMenu = item.name;
      },
      toggleDrawer() {
        this.isDrawerCollapsed = !this.isDrawerCollapsed;
      },
      checkWindowSize() {
        this.isDrawerCollapsed = window.innerWidth < 1400;
      },
    },
  };
  </script>
  
  <style scoped>
  /* Main Layout */
  .app-container {
    display: flex;
    height: 100vh;
    font-family: "Inter", sans-serif;
  }
  
  /* Navigation Drawer */
  .navigation-drawer {
    width: 250px;
    background-color: #2c3e50;
    color: #fff;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    position: relative;
  }
  
  .navigation-drawer.collapsed {
    width: 60px;
  }
  
  .drawer-header {
    padding: 1rem;
    text-align: center;
    background-color: #34495e;
  }
  
  .logo {
    font-size: 1.5rem;
    font-weight: bold;
  }
  
  .menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .menu-list li {
    padding: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
    text-align: center;
  }
  
  .menu-list li.active,
  .menu-list li:hover {
    background-color: #1abc9c;
  }
  
  .drawer-toggle {
    width: 100%;
    background-color: #1abc9c;
    border: none;
    padding: 1rem;
    cursor: pointer;
    color: #fff;
    font-size: 1.2rem;
    position: absolute;
    bottom: 0;
    text-align: center;
  }
  
  .drawer-toggle:hover {
    background-color: #16a085;
  }
  
  /* Main Content */
  .main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  
  .top-bar {
    height: 60px;
    background: #ecf0f1;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  .top-bar h1 {
    font-size: 1.2rem;
    margin: 0;
    color: #2c3e50;
  }
  
  .content {
    flex: 1;
    background: #f7f7f7;
    padding: 1rem;
  }
  </style>
  