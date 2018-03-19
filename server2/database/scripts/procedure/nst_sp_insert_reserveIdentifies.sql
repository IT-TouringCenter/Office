/*DROP PROCEDURE IF EXISTS*/
DROP PROCEDURE IF EXISTS nst_sp_insert_reserveIdentifies;

DELIMITER $$

CREATE PROCEDURE nst_sp_insert_reserveIdentifies(IN identify INT,IN activityId INT)
BEGIN

	INSERT INTO reserve_identifies
	(
		identify,
		activity_id,
		is_used,
		is_active,
		created_by,
		created_at
	)
	VALUES(
		identify,
		activityId,
		'1',
		'1',
		'System',
		CURDATE()
	);
	
END $$

DELIMITER ;