SELECT
  u.id,
  u.name,
  count(p.phone)
FROM users u
INNER JOIN