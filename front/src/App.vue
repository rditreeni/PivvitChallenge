<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link to="/" class="nav-link">
              Purchases
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/new-purchase"
              >New Purchase</router-link
            >
          </li>
        </ul>
      </div>
    </nav>
    <br /><br />
    <router-view />
  </div>
</template>
