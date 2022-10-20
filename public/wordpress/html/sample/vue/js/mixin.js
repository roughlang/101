// ミックスインオブジェクト
var utility_mixin = {
  data: {
    a: 'foo',
    b: 'bar'
  },
  created: function () {
    this.hello()
  },
  methods: {
    hello: function () {
      return this.message = 'Hello from mixin!';
    },
    goodby: function() {
      return this.message = 'Goodby!';
    }
  },
  data: function () {
    return {
      message: 'Hello!'
    }
  }
}