<template>
  <Head :title="title" />
  <Layout>
    <section v-if="photo" class="photo-detail">
      <div class="cover">
        <img class="bg" :src="photo.pivot.regular_url" :alt="title">
      </div>
      <div class="content">
        <img class="image" :src="photo.pivot.full_url" :alt="title">
        <div class="info">
          <div class="description">
            <p><span :style="'background-color: ' + photo.color"></span>{{ photo.description }}</p>
            <div class="download-links">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4"></path>
                  <line x1="12" y1="13" x2="12" y2="22"></line>
                  <polyline points="9 19 12 22 15 19"></polyline>
                </svg>
              </span>
              <a target="_blank" :href="photo.pivot.raw_url" :download="photo.photo_id + '_' + photo.artist_id + '_raw.jpg'">RAW</a>
              <a target="_blank" :href="photo.pivot.full_url" :download="photo.photo_id + '_' + photo.artist_id + '_full.jpg'">FULL</a>
              <a target="_blank" :href="photo.pivot.regular_url" :download="photo.photo_id + '_' + photo.artist_id + '_regular.jpg'">REGULAR</a>
              <a target="_blank" :href="photo.pivot.small_url" :download="photo.photo_id + '_' + photo.artist_id + '_small.jpg'">SMALL</a>
              <a target="_blank" :href="photo.pivot.thumb_url" :download="photo.photo_id + '_' + photo.artist_id + '_thumb.jpg'">THUMB</a>
            </div>
          </div>
          <div class="summary">
            <p class="likes">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
              </svg>
              {{photo.likes}}
            </p>
            <div v-if="artist" class="links">
              <a class="artist" :href="artist.link" target="_blank" noreferrer noopener>
                <img loading="lazy" :src="artist.avatar" :alt="artist.name">
                <span>{{artist.name}} <small>@{{artist.username}}</small></span>
              </a>
              <Link :href="'/artist/' + artist.artist_id">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <line x1="5" y1="12" x2="11" y2="18"></line>
                  <line x1="5" y1="12" x2="11" y2="6"></line>
                </svg>
                <span>Go Back to Artist Page</span>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>
  </Layout>
</template>
<script>
import Layout from '../Sharred/Layout'
import { Head, Link } from '@inertiajs/inertia-vue3'
export default {
  components: {
    Head,
    Link,
    Layout,
  },
  props: {
    title: String,
    artist: Object,
    photo: Object,
  },
}
</script>