<template>
  <div class="artist-card">
    <div class="artist-card-body">
      <img :src="artist.avatar" :alt="artist.name">
      <h5>{{artist.name}}</h5>
      <span>{{artist.bio}}</span>
      <div class="artist-card--buttons">
        <Link :href="'artist/' + artist.artist_id" class="btn btn-primary">View Portfolio</Link>
        <a rel="noopener noreferrer" target="_blank" :href="artist.link" class="btn btn-secondary">View on Unsplash</a>
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