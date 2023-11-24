import { defineStore } from "pinia";

export const useCounterStore = defineStore("counter", {
  state: () => {
    return { count: 0,
        total: 20,
    };
  },
  actions: {
    increment(value = 1) {
      this.count += value;
    },
  },
  getters: {
    doubleCount: (state) => {
      return state.count * 2;
    },
    doublePlusOne() {
      return this.doubleCount + 1;
    },
    divideByTotal(state) {
        return this.doublePlusOne / state.total;
    }
  },
});
