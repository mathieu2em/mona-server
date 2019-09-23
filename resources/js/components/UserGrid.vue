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
      <template v-slot:cell(collection)="row">
        {{ row.value.length }}
      </template>

      <template v-slot:cell(details)="row">
        <b-button size="sm" @click="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>
      </template>

      <template slot="row-details" slot-scope="row">
        <b-card>
          <ul class="list-group list-group-flush">
            <li v-for="value in row.item.collection" class="list-group-item">
              <b>Title:</b>
              <span>{{ value.title }}</span>
              <br>
              <b>Location:</b>
              <span>({{ value.location.lat }}, {{ value.location.lng }})</span>
              <br>
              <b>Rating:</b>
              <span>{{ value.pivot.rating }}</span>
              <br>
              <b>Comment:</b>
              <span>{{ value.pivot.comment }}</span>
              <br>
              <b>Photo:</b>
              <br>
              <img v-if="value.pivot.photo" v-bind:src="value.pivot.photo | url" height="460px">
            </li>
          </ul>
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
    props: ['users'],
    data() {
      return {
        items: this.users,
        fields: [
          { key: 'id' },
          { key: 'created_at', label: 'Created At', sortable: true },
          { key: 'updated_at', label: 'Updated At', sortable: true },
          { key: 'role' },
          { key: 'collection', label: 'Collection', sortable: true },
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
      this.totalRows = this.items.length
    },
    methods: {
      onFiltered(filteredItems) {
        this.totalRows = filteredItems.length
        this.currentPage = 1
      }
    },
    filters: {
      url: function (value) {
        return '../' + value.replace('public', 'storage')
      }
    },
    components: {
      'b-container': BootstrapVue.BContainer,
      'b-row': BootstrapVue.BRow,
      'b-col': BootstrapVue.BCol,
      'b-form-group': BootstrapVue.BFormGroup,
      'b-input-group': BootstrapVue.BInputGroup,
      'b-form-input': BootstrapVue.BFormInput,
      'b-input-group-append': BootstrapVue.BInputGroupAppend,
      'b-button': BootstrapVue.BButton,
      'b-form-select': BootstrapVue.BFormSelect,
      'b-table': BootstrapVue.BTable,
      'b-pagination': BootstrapVue.BPagination,
      'b-card': BootstrapVue.BCard,
    }
  }
</script>
