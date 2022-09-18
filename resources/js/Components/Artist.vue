<template>
  <div class="artist-card">
    <div class="artist-card-body">
      <img loading="lazy" :src="artist.avatar" :alt="artist.name">
      <h5>{{artist.name}}</h5>
      <p>{{artist.bio}}</p>
      <div class="artist-card--buttons">
        <Link :href="'artist/' + artist.artist_id" class="btn btn-primary">View Portfolio</Link>
        <a rel="noopener noreferrer" target="_blank" :href="artist.link" class="btn btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <line x1="17" y1="7" x2="7" y2="17"></line>
            <polyline points="8 7 17 7 17 16"></polyline>
          </svg>
          View on Unsplash</a>
      </div>
    </div>
  </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
  components: {
    Link
  },
  props: {
    artist: Object,
  },
}
</script>