SELECT tabla1_fecha.idtabla1, tabla2.fecha, tabla2.descripcion, tabla3.fecha, tabla3.descripcion, tabla4.fecha, tabla4.descripcion 
FROM 
(
    SELECT tabla1.idtabla1, fechas.fecha
    FROM tabla1 
    INNER JOIN 
    (
        SELECT fecha FROM tabla2
        UNION
        SELECT fecha FROM tabla3
        UNION
        SELECT fecha FROM tabla4    
    ) fechas
) tabla1_fecha 
LEFT JOIN tabla2 ON tabla1_fecha.idtabla1 = tabla2.fk_tabla1 AND tabla1_fecha.fecha = tabla2.fecha
LEFT JOIN tabla3 ON tabla1_fecha.idtabla1 = tabla3.fk_tabla1 AND tabla1_fecha.fecha = tabla3.fecha
LEFT JOIN tabla4 ON tabla1_fecha.idtabla1 = tabla4.fk_tabla1 AND tabla1_fecha.fecha = tabla4.fecha;