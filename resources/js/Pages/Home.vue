<template>
  <Head :title="title" />
  <Layout>
    <section class="hero">
      <h1>{{sub_title}}</h1>
      <p class="lead text-muted">{{description}}</p>
    </section>
    <section class="artists">
      <h2>Artists</h2>
      <template v-if="artists && artists.length > 0">
        <div class="artists-list">
          <div class="artists-list--item" v-for="artist in artists" :key="artist.id">
            <Artist :artist="artist" />
          </div>
        </div>
        <nav v-if="lastPage > 1" class="pagination" aria-label="Artist list pagination">
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
        <p>No artists found.</p>
      </div>
    </section>
  </Layout>
</template>
<script>
import Layout from '../Sharred/Layout'
import Artist from '../Components/Artist'
import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Head,
    Link,
    Artist,
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
    sub_title: String,
    description: String,
    artists: Object,
    totalRecord: Number,
    lastPage: Number,
    currentPageNum: Number,
  },
}
</script>