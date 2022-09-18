<template>
  <Head :title="title" />
  <Layout>
    <section class="artist-hero">
      <h1>{{artist.name}}</h1>
      <p>
        <span v-if="artist.location">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <circle cx="12" cy="11" r="3"></circle>
            <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
          </svg>
          {{artist.location}}
        </span>
        {{artist.bio}}
        <a :href="artist.link" target="_blank" rel="noopener noreferrer">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <line x1="17" y1="7" x2="7" y2="17"></line>
            <polyline points="8 7 17 7 17 16"></polyline>
          </svg>
          View on Unsplash
        </a>
      </p>
      <img loading="lazy" :src="artist.avatar" :alt="artist.name" class="artist-avatar" />
      <div class="artist-bg">
        <img loading="lazy" :src="artist.avatar" :alt="artist.name" />
      </div>
    </section>
    <section class="photos">
      <h2>Portfolio</h2>
      <template v-if="photos && photos.length > 0">
        <div class="photos-list">
          <div class="photos-list--item" v-for="photo in photos" :key="photo.id">
            <Photo :photo="photo" />
          </div>
        </div>
        <nav v-if="lastPage > 1" class="pagination" aria-label="Portfolio list pagination">
          <ul>
            <li>
              <Link :class="currentPageNum <= 1 ? 'disabled' : ''" :href="'/?page='+(currentPageNum-1)">Previous</Link>
            </li>
            <li v-for="pageNum in previousPages" :key="pageNum">
              <Link :href="typeof pageNum === 'number' ? '/?page=' + pageNum : '#'">{{pageNum}}</Link>
            </li>
            <li>
              <Link :href="'/?page=' + currentPageNum" aria-current="page" class="active">{{currentPageNum}}</Link>
            </li>
            <li v-for="pageNum in nextPages" :key="pageNum">
              <Link :href="typeof pageNum === 'number' ? '/?page=' + pageNum : '#'">{{pageNum}}</Link>
            </li>
            <li>
              <Link :class="currentPageNum >= lastPage ? 'disabled' : ''" :href="'/?page='+(currentPageNum+1)">Next</Link>
            </li>
          </ul>
        </nav>
      </template>
      <div v-else class="alert alert-danger">
        <p>No photos found.</p>
      </div>
    </section>
  </Layout>
</template>
<script>
import Layout from '../Sharred/Layout'
import Photo from '../Components/Photo'
import { Head, Link } from '@inertiajs/inertia-vue3'
export default {
  components: {
    Head,
    Link,
    Photo,
    Layout,
  },
  computed: {
    previousPages() {
      const pages = [];
      let x = 0;
      if (this.currentPageNum > 1) {
        for (let i = this.currentPageNum; i >= 1; i--) {
          if (i < this.currentPageNum) {
            x++;
            pages.push(i);
            if (x === 4 && ((i - 2) > 1)) {
              pages.push('...');
              pages.push(1);
              break;
            }
          }
        }
      }
      return pages.reverse();
    },
    nextPages() {
      const pages = [];
      let x = 0;
      for (let i = (this.currentPageNum + 1); i <= this.lastPage; i++) {
        x++;
        pages.push(i);

        if (x === 4 && i < this.lastPage && ((i + 2) < this.lastPage)) {
          pages.push('...');
          pages.push(this.lastPage);
          break;
        }
      }
      return pages;
    },
  },
  props: {
    title: String,
    artist: Object,
    photos: Object,
    totalRecord: Number,
    lastPage: Number,
    currentPageNum: Number,
  },
}
</script>