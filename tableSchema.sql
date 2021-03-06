CREATE TABLE [dbo].[IndetSuspLungNodules](
	[nodule_pk] [int] IDENTITY(1,1) NOT NULL,
	[consistency] [varchar](50) NULL,
	[location] [varchar](50) NULL,
	[ct_series] [int] NULL,
	[ct_slice] [int] NULL,
	[size_width_mm] [int] NULL,
	[size_height_mm] [int] NULL,
	[mean_diameter_mm] [int] NULL,
	[evolution] [varchar](50) NULL,
	[lung_rads_category] [varchar](3) NULL,
 CONSTRAINT [PK_IndetSuspLungNodules] PRIMARY KEY CLUSTERED 
(
	[nodule_pk] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
