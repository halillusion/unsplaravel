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
  <main>
    {{title}}
    <slot></slot>
  </main>
</template>

<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
export default {
  components: {
    Link, Head,
  },
}
</script>