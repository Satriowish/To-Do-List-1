USE todolist;
GO

-- Tabel todos
CREATE TABLE todos (
    id INT NOT NULL IDENTITY(1,1),  
    title NVARCHAR(MAX) NOT NULL,    
    date_time DATETIME NOT NULL DEFAULT GETDATE(),  
    checked BIT NOT NULL DEFAULT 0,  
    PRIMARY KEY (id)                
);
GO

-- Insert data 
INSERT INTO todos (title, date_time, checked) 
VALUES 
('Tugas Manajemen Proyek', '2024-10-22 12:00:00', 1),
('Tugas Pemrograman Web', '2024-10-26 07:30:00', 1);
GO
