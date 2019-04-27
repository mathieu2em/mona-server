<template>
  <b-container fluid>
    <b-row>
      <b-col md="6" class="my-1">
        <b-form-group label-cols-sm="3" label="Filter" class="mb-0">
          <b-input-group>
            <b-form-input v-model="filter" placeholder="Type to Search"></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col md="6" class="my-1">
        <b-form-group label-cols-sm="3" label="Sort" class="mb-0">
          <b-input-group>
            <b-form-select v-model="sortBy" :options="sortOptions">
              <option slot="first" :value="null">-- none --</option>
            </b-form-select>
            <b-form-select v-model="sortDesc" :disabled="!sortBy" slot="append">
              <option :value="false">Asc</option> <option :value="true">Desc</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col md="6" class="my-1">
        <b-form-group label-cols-sm="3" label="Per page" class="mb-0">
          <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
        </b-form-group>
      </b-col>
    </b-row>

    <b-table
      show-empty
      stacked="md"
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered">
      <template slot="category" slot-scope="row">
        {{ row.value.fr }}
      </template>

      <template slot="subcategory" slot-scope="row">
        {{ row.value.fr }}
      </template>

      <template slot="artists" slot-scope="row">
        <ul>
          <li v-for="value in row.value">{{ value.name }} {{ value.collective ? '(Collectif)' : '' }}</li>
        </ul>
      </template>

      <template slot="ratings" slot-scope="row">
        {{ row.value.len }}
      </template>

      <template slot="comments" slot-scope="row">
        {{ row.value.length }}
      </template>

      <template slot="details" slot-scope="row">
        <b-button size="sm" @click="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>
      </template>

      <template slot="row-details" slot-scope="row">
        <b-card>
          <p><b>ID:</b> <span>{{ row.item.id }}</span></p>
          <p><b>Dimensions:</b> <span>{{ row.item.dimensions }}</span></p>
          <p>
            <b>Materials:</b>
            <ul><li v-for="value in row.item.materials">{{ value.fr }}</li></ul>
          </p>
          <p>
            <b>Techniques:</b>
            <ul><li v-for="value in row.item.techniques">{{ value.fr }}</li></ul>
          </p>
          <p>
            <b>Location:</b>
            <!-- TODO Use map -->
            <span>({{ row.item.location.lat }}, {{ row.item.location.lng }})</span>
          </p>
          <p v-if="row.item.ratings.len">
            <b>Ratings:</b>
            <ul>
              <li><b>Minimum:</b> <span>{{ row.item.ratings.min }}</span></li>
              <li><b>Maximum:</b> <span>{{ row.item.ratings.max }}</span></li>
              <li><b>Average:</b> <span>{{ row.item.ratings.avg }}</span></li>
              <li><b>Median:</b> <span>{{ row.item.ratings.med }}</span></li>
            </ul>
          </p>
          <p v-if="row.item.comments.length">
            <b>Comments:</b>
            <ul><li v-for="value in row.item.comments">{{ value }}</li></ul>
          </p>
        </b-card>
      </template>
    </b-table>

    <!-- TODO Center + Make bigger -->
    <b-row>
      <b-col md="12" class="my-1">
        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          class="my-0">
        </b-pagination>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
  export default {
    props: ['artworks'],
    data() {
      return {
        items: this.artworks,
        fields: [
          { key: 'title', label: 'Title', sortable: true },
          { key: 'produced_at', label: 'Produced At', sortable: true },
          { key: 'category', label: 'Category', sortable: true },
          { key: 'subcategory', label: 'Subcategory', sortable: true },
          /*{ key: 'materials' },*/
          /*{ key: 'techniques' },*/
          { key: 'artists' },
          { key: 'borough', label: 'Borough', sortable: true },
          { key: 'ratings', label: 'Ratings', sortable: true },
          { key: 'comments', label: 'Comments', sortable: true },
          { key: 'details', _showDetails: true },
        ],
        totalRows: 0,
        currentPage: 1,
        perPage: 20,
        pageOptions: [10, 20, 30, 40, 50],
        sortBy: null,
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
      }
    },
    computed: {
      sortOptions() {
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      }
    },
    mounted() {
      this.items.forEach(i => i.ratings = {
        len: i.ratings.length,
        min: i.ratings.length ? this.min(i.ratings) : null,
        max: i.ratings.length ? this.max(i.ratings) : null,
        avg: i.ratings.length ? this.avg(i.ratings) : null,
        med: i.ratings.length ? this.med(i.ratings) : null,
      })
      this.totalRows = this.items.length
    },
    methods: {
      onFiltered(filteredItems) {
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      min(arr) {
        return Math.min(...arr)
      },
      max(arr) {
        return Math.max(...arr)
      },
      avg(arr) {
        return arr.reduce((prev, curr) => curr += prev) / arr.length
      },
      med(arr) {
        arr.sort((a, b) => a - b)
        return (arr[(arr.length - 1) >> 1] + arr[arr.length >> 1]) / 2
      }
    }
  }
</script>
