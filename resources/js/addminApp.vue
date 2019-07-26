<template>
  <div class="container">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link :to="{ name: 'dashboard' }" class="nav-link">dashboard</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'users' }" class="nav-link">Users</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'posts' }"  class="nav-link">Posts</router-link>
        </li>  <li class="nav-item">
          <router-link :to="{ name: 'contactus' }"  class="nav-link">contact us</router-link>
        </li>
      </ul>
    </nav>
    <br />
    <transition name="fade">
      <router-view></router-view>
    </transition>
  </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
</style>

<script>

    export default{
    }
</script>