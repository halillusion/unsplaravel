<template>
  <Link :href="'/photo/'+photo.photo_id" class="photo-card">
    <div class="photo-card-body">
      <img loading="lazy" :src="photo.pivot.regular_url" :alt="photo.description">
    </div>
    <span class="likes">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
      </svg>
      {{photo.likes}}
    </span>
    <span class="description">{{photo.description}}</span>
  </Link>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
  components: {
    Link
  },
  props: {
    photo: Object,
  },
}
</script>