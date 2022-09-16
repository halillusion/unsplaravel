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
        <nav class="pagination" aria-label="Artist list pagination">
          <ul>
            <li>
              <Link href="/?page=1">Previous</Link>
            </li>
            <li>
              <Link href="/?page=1">1</Link>
            </li>
            <li>
              <Link href="/?page=2">2</Link>
            </li>
            <li>
              <Link href="/?page=3" aria-current="page" class="active">3</Link>
            </li>
            <li>
              <Link href="/?page=4">4</Link>
            </li>
            <li>
              <Link href="/?page=5">5</Link>
            </li>
            <li>
              <Link href="/?page=4">Next</Link>
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
  props: {
    title: String,
    sub_title: String,
    description: String,
    artists: Object,
    totalRecord: Number,
    lastPage: Number,
    page: Number,
  },
}
</script>