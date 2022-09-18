<template>
  <nav class="navigation">
    <div class="navigation-wrap">
      <Link :href="'/'" class="navigation--brand">Unsplaravel</Link>
      <div class="navigation--links">
        <ul>
          <li>
            <Link :href="'/'" >Discover</Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <Transition>
    <main v-if="show" :key="$page.url">
      <slot></slot>
    </main>
  </Transition>
  <footer>Copyright &copy; {{(new Date()).getFullYear()}} - The rights of the photos belong to the respective artists. <a href="https://github.com/halillusion" target="_blank">@halillusion</a></footer>
</template>

<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
export default {
  data() {
    return {
      show: false,
    }
  },
  mounted() {
    this.show = true
  },
  components: {
    Link, Head,
  },
}
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>