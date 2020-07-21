<template>
  <div class="md-layout">
    <div class="md-layout-item md-size-100">
      <md-card>
        <md-card-header class="md-card-header-icon md-card-header-green">
          <div class="card-icon">
            <md-icon>assignment</md-icon>
          </div>
          <h4 class="title">Users List</h4>
        </md-card-header>
        <md-card-content>
          <div class="text-right">
            <md-button class="md-primary md-dense" @click="onProFeature">
              Add User
            </md-button>
          </div>
          <md-table
            :value="table"
            :md-sort.sync="sortation.field"
            :md-sort-order.sync="sortation.order"
            :md-sort-fn="customSort"
            class="paginated-table table-striped table-hover"
          >
            <md-table-toolbar>

              <md-field>
                <label>Per page</label>
                <md-select v-model="pagination.perPage" name="pages">
                  <md-option
                    v-for="item in pagination.perPageOptions"
                    :key="item"
                    :label="item"
                    :value="item"
                  >
                    {{ item }}
                  </md-option>
                </md-select>
              </md-field>

            </md-table-toolbar>

            <md-table-row slot="md-table-row" slot-scope="{ item }">
              <md-table-cell md-label="Name" md-sort-by="name">{{item.name}}</md-table-cell>
              <md-table-cell md-label="Email" md-sort-by="email">{{item.email}}</md-table-cell>
              <md-table-cell md-label="Created At" md-sort-by="created_at">{{item.created_at}}</md-table-cell>
              <md-table-cell md-label="Actions">
                <md-button class="md-icon-button md-raised md-round md-info" @click="onProFeature" style="margin: .2rem;">
                  <md-icon>edit</md-icon>
                </md-button>
                <md-button class="md-icon-button md-raised md-round md-danger" @click="onProFeature" style="margin: .2rem;">
                  <md-icon>delete</md-icon>
                </md-button>
              </md-table-cell>
            </md-table-row>
          </md-table>

          <div class="footer-table md-table">
            <table>
              <tfoot>
              <tr>
                <th v-for="item in footerTable" :key="item.name" class="md-table-head">
                  <div class="md-table-head-container md-ripple md-disabled">
                    <div class="md-table-head-label">
                      {{ item }}
                    </div>
                  </div>
                </th>
              </tr>
              </tfoot>
            </table>
          </div>

        </md-card-content>

        <md-card-actions md-alignment="space-between">
          <div class="">
            <p class="card-category">
              Showing {{ from + 1 }} to {{ to }} of {{ total }} entries
            </p>
          </div>
          <pagination
            class="pagination-no-border pagination-success"
            v-model="pagination.currentPage"
            :per-page="pagination.perPage"
            :total="total"
          />
        </md-card-actions>

      </md-card>
    </div>
  </div>
</template>

<script>

  import Pagination from "@/components/Pagination";

  export default {

    components: {
      "pagination": Pagination
    },

    data: () => ({
      table: [],
      footerTable: ["Name", "Email", "Created At", "Actions"],

      query: null,

      sortation: {
        field: "created_at",
        order: "asc"
      },

      pagination: {
        perPage: 5,
        currentPage: 1,
        perPageOptions: [5, 10, 25, 50]
      },

      total: 1

    }),

    computed: {

      sort() {
        if (this.sortation.order === "desc") {
          return `-${this.sortation.field}`
        }

        return this.sortation.field;
      },

      from() {
        return this.pagination.perPage * (this.pagination.currentPage - 1);
      },

      to() {
        let highBound = this.from + this.pagination.perPage;
        if (this.total < highBound) {
          highBound = this.total;
        }
        return highBound;
      },

    },

    created() {
      this.getList()
    },

    methods: {

      getList() {
        this.table = [{
          name: "Admin",
          email: "admin@material.com",
          created_at: "2020-01-01"
        }]
      },

      onProFeature() {
        this.$store.dispatch("alerts/error", "This is a PRO feature.")
      },

      customSort() {
        return false
      }

    }

  }

</script>