<template>
  <div class="md-layout">
    <div class="md-layout-item md-size-100">
      <md-card>
        <md-card-header class="md-card-header-icon md-card-header-green">
          <div class="card-icon">
            <md-icon>assignment</md-icon>
          </div>
          <h4 class="title">Simple Table</h4>
        </md-card-header>
        <md-card-content>
          <md-table v-model="tableData" table-header-color="green">
            <md-table-row slot="md-table-row" slot-scope="{ item }">
              <md-table-cell md-label="ID">{{ item.id }}</md-table-cell>
              <md-table-cell md-label="Name">{{ item.name }}</md-table-cell>
              <md-table-cell md-label="Country">{{
                item.country
              }}</md-table-cell>
              <md-table-cell md-label="City">{{ item.city }}</md-table-cell>
              <md-table-cell md-label="Salary">{{ item.salary }}</md-table-cell>
            </md-table-row>
          </md-table>
        </md-card-content>
      </md-card>
    </div>
    <div class="md-layout-item md-size-100">
      <md-card class="md-card-plain">
        <md-card-header class="md-card-header-icon md-card-header-green">
          <div class="card-icon">
            <md-icon>assignment</md-icon>
          </div>
          <h4 class="title mt-0">Table on Plain Background</h4>
          <p class="category">Here is a subtitle for this table</p>
        </md-card-header>
        <md-card-content>
          <md-table v-model="tableDataPlain">
            <md-table-row slot="md-table-row" slot-scope="{ item }">
              <md-table-cell md-label="ID">{{ item.id }}</md-table-cell>
              <md-table-cell md-label="Name">{{ item.name }}</md-table-cell>
              <md-table-cell md-label="Country">{{
                item.country
              }}</md-table-cell>
              <md-table-cell md-label="City">{{ item.city }}</md-table-cell>
              <md-table-cell md-label="Salary">{{ item.salary }}</md-table-cell>
            </md-table-row>
          </md-table>
        </md-card-content>
      </md-card>
    </div>
    <div class="md-layout-item md-size-100">
      <md-card>
        <md-card-header class="md-card-header-icon md-card-header-green">
          <div class="card-icon">
            <md-icon>assignment</md-icon>
          </div>
          <h4 class="title">Regular Table with Colors</h4>
        </md-card-header>
        <md-card-content>
          <md-table v-model="tableDataColor" class="table-full-width">
            <md-table-row
              slot="md-table-row"
              slot-scope="{ item }"
              :class="getClass(item)"
            >
              <md-table-cell md-label="ID">{{ item.id }}</md-table-cell>
              <md-table-cell md-label="Name">{{ item.name }}</md-table-cell>
              <md-table-cell md-label="Country">{{
                item.country
              }}</md-table-cell>
              <md-table-cell md-label="City">{{ item.city }}</md-table-cell>
              <md-table-cell md-label="Salary">{{ item.salary }}</md-table-cell>
            </md-table-row>
          </md-table>
        </md-card-content>
      </md-card>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      selected: [],
      tableData: [
        {
          id: 1,
          name: "Dakota Rice",
          salary: "$36.738",
          country: "Niger",
          city: "Oud-Turnhout"
        },
        {
          id: 2,
          name: "Minerva Hooper",
          salary: "$23,789",
          country: "Curaçao",
          city: "Sinaai-Waas"
        },
        {
          id: 3,
          name: "Sage Rodriguez",
          salary: "$56,142",
          country: "Netherlands",
          city: "Baileux"
        },
        {
          id: 4,
          name: "Philip Chaney",
          salary: "$38,735",
          country: "Korea, South",
          city: "Overland Park"
        },
        {
          id: 5,
          name: "Doris Greene",
          salary: "$63,542",
          country: "Malawi",
          city: "Feldkirchen in Kärnten"
        }
      ],
      tableDataPlain: [
        {
          id: 1,
          name: "Dakota Rice",
          salary: "$36.738",
          country: "Niger",
          city: "Oud-Turnhout"
        },
        {
          id: 2,
          name: "Minerva Hooper",
          salary: "$23,789",
          country: "Curaçao",
          city: "Sinaai-Waas"
        },
        {
          id: 3,
          name: "Sage Rodriguez",
          salary: "$56,142",
          country: "Netherlands",
          city: "Baileux"
        },
        {
          id: 4,
          name: "Philip Chaney",
          salary: "$38,735",
          country: "Korea, South",
          city: "Overland Park"
        },
        {
          id: 5,
          name: "Doris Greene",
          salary: "$63,542",
          country: "Malawi",
          city: "Feldkirchen in Kärnten"
        }
      ],
      tableDataColor: [
        {
          id: 1,
          name: "Dakota Rice",
          salary: "$36.738",
          country: "Niger",
          city: "Oud-Turnhout"
        },
        {
          id: 2,
          name: "Minerva Hooper",
          salary: "$23,789",
          country: "Curaçao",
          city: "Sinaai-Waas"
        },
        {
          id: 3,
          name: "Sage Rodriguez",
          salary: "$56,142",
          country: "Netherlands",
          city: "Baileux"
        },
        {
          id: 4,
          name: "Philip Chaney",
          salary: "$38,735",
          country: "Korea, South",
          city: "Overland Park"
        },
        {
          id: 5,
          name: "Philip Chaney",
          salary: "$38,735",
          country: "Korea, South",
          city: "Overland Park"
        },
        {
          id: 6,
          name: "Philip Chaney",
          salary: "$38,735",
          country: "Korea, South",
          city: "Overland Park"
        },
        {
          id: 7,
          name: "Doris Greene",
          salary: "$63,542",
          country: "Malawi",
          city: "Feldkirchen in Kärnten"
        }
      ]
    };
  },
  methods: {
    getClass: ({ id }) => ({
      "table-success": id === 1,
      "table-info": id === 3,
      "table-danger": id === 5,
      "table-warning": id === 7
    })
  }
};
</script>
<style scoped>
.table-transparent {
  background-color: transparent !important;
}

.mt-0 {
  margin-top: 0 !important;
}
</style>
