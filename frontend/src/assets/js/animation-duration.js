const values = {
  1: 150,
  2: 300,
  3: 500,
  4: 1000
}

const msDur = {};
const sDur = {};

for (let value in values) {
  msDur[value] = values[value];
  sDur[value] = values[value] / 1000;
}

export { values, sDur, msDur };