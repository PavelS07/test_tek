SELECT name, SUM(price) as 'Суммарная стоимость лотов', SUM(amount) as 'Суммарное количество позиций' FROM procedures
INNER JOIN lots ON lots.procedure_id=procedures.id
INNER JOIN positions ON positions.lot_id=lots.id
GROUP BY name
ORDER BY name;
