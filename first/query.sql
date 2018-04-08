SELECT
  u.id id,
  u.name name,
  count(pn.phone) phones_count
FROM users u
INNER JOIN phone_numbers pn ON u.id = pn.user_id
WHERE YEAR(NOW()) - YEAR(u.birth_date) BETWEEN 18 AND 22;

SELECT YEAR('2017-01-01') - YEAR(NOW());