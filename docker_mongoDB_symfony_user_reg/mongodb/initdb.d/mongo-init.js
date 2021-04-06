db = db.getSiblingDB('admin')
db.auth('root', 'root')
db = db.getSiblingDB('symfony')

db.createUser({
  user: "symfony",
  pwd: "symfony",
  roles: [{role: "readWrite", db: "symfony"}]
});