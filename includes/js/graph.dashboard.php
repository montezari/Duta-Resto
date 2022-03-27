<?php
require_once "includes/config.inc.php";
require_once "includes/connect.inc.php";
/*
// pie -> biaya
$sql  = "SELECT biaya.cBiaya, biaya.vBiaya, COALESCE(peg.jml,0) AS jml ";
$sql .= "FROM (SELECT 1 AS cBiaya, 'Langsung' AS vBiaya UNION ALL SELECT 2 AS cJK, 'Tidak Langsung' AS vBiaya ) biaya ";
$sql .= "LEFT JOIN ( ";
$sql .= "  SELECT cBiaya, COUNT(*) AS jml "; 
$sql .= "  FROM tm_pegawai WHERE dTglResign IS NULL "; 
$sql .= "  GROUP BY cBiaya ";
$sql .= ") peg ON peg.cBiaya = biaya.cBiaya ";
$rs = $conn->Execute($sql);
$pie_biaya  = "var data1 = []; \n";
$pie_biaya .= "var series1 = ".$rs->RecordCount()."; \n";
$idx=0;
while(!$rs->EOF){
  $pie_biaya .= "data1[$idx] = { \n";
  $pie_biaya .= "	label: \"".strtoupper($rs->fields["vBiaya"])."\", \n";
  $pie_biaya .= "	data: ".$rs->fields["jml"]." \n";
  $pie_biaya .= "} \n";
  $idx++;
  $rs->MoveNext();
}
$rs->Close();

// pie -> status pegawai
$sql  = "SELECT stat.cKdStatus, stat.vNmStatus, COALESCE(peg.jml,0) AS jml ";
$sql .= "FROM tm_statuspegawai stat ";
$sql .= "LEFT JOIN ( ";
$sql .= "  SELECT cStatusPegawai, COUNT(*) AS jml ";
$sql .= "  FROM tm_pegawai WHERE dTglResign IS NULL ";  
$sql .= "  GROUP BY cStatusPegawai ";
$sql .= ") peg ON peg.cStatusPegawai = stat.cKdStatus ";
$rs = $conn->Execute($sql);
$pie_status  = "var data2 = []; \n";
$pie_status .= "var series2 = ".$rs->RecordCount()."; \n";
$idx=0;
while(!$rs->EOF){
  $pie_status .= "data2[$idx] = { \n";
  $pie_status .= "	label: \"".strtoupper($rs->fields["vNmStatus"])."\", \n";
  $pie_status .= "	data: ".$rs->fields["jml"]." \n";
  $pie_status .= "} \n";
  $idx++;
  $rs->MoveNext();
}
$rs->Close();

// jumlah pegawai per kantor
$sql  = "SELECT knt.cKdKantor, knt.vNmKantor, COALESCE(peg.jml,0) AS jml "; 
$sql .= "FROM tm_kantor knt ";
$sql .= "LEFT JOIN ( ";
$sql .= "  SELECT cKdKantor, COUNT(*) AS jml "; 
$sql .= "  FROM tm_pegawai WHERE dTglResign IS NULL "; 
$sql .= "  GROUP BY cKdKantor ";
$sql .= ") peg ON peg.cKdKantor = knt.cKdKantor ";
$rs = $conn->Execute($sql);
$bar_jml  = "var data1 = [ ";
$bykdata = $rs->RecordCount();
$idx = 1;
while(!$rs->EOF){
  $sep = $idx<$bykdata ? "," : "";
  $bar_jml .= "[\"".strtoupper($rs->fields["vNmKantor"])."\", ".$rs->fields["jml"]."]".$sep;
  $idx++;
  $rs->MoveNext();
}
$bar_jml .= "];";
$rs->Close();
*/

$sql  = "SELECT tgl.cDay, COALESCE(jual.nInvNetto,0) AS nInvNetto FROM ".$config["db_mst"].".ms_tanggal tgl ";
$sql .= "LEFT JOIN ( ";
$sql .= "  SELECT SUM(nInvNetto) AS nInvNetto, DATE_FORMAT(dTglInv,'%d') AS dTglInv "; 
$sql .= "  FROM tr_fakturhd WHERE YEAR(dTglInv) = YEAR(CURRENT_DATE()) AND MONTH(dTglInv) = MONTH(CURRENT_DATE()) ";
$sql .= "  GROUP BY DATE_FORMAT(dTglInv,'%Y-%m-%d') ";
$sql .= ") jual ON tgl.cDay = jual.dTglInv ";
$sql .= "WHERE tgl.cDay <= DATE_FORMAT(LAST_DAY(CONCAT(YEAR(CURRENT_DATE()),'-',MONTH(CURRENT_DATE()),'-','1')),'%d') ";
$rs = $conn->Execute($sql);
$rev_chart  = "var likes = [ ";
$bykdata = $rs->RecordCount();
$idx = 1;
while(!$rs->EOF){
  $sep = $idx<$bykdata ? "," : "";
  $rev_chart .= "[".$rs->fields["cDay"].",".$rs->fields["nInvNetto"]."]".$sep;
  $idx++;
  $rs->MoveNext();
}
$rev_chart .= "];";
$rs->Close();


$sql  = "SELECT tgl.cDay, COALESCE(tamu.jml,0) AS jml FROM ".$config["db_mst"].".ms_tanggal tgl ";
$sql .= "LEFT JOIN ( ";
$sql .= "  SELECT COUNT(*) AS jml, DATE_FORMAT(dTglMasuk,'%d') AS dTglMasuk "; 
$sql .= "  FROM tr_tamu WHERE YEAR(dTglMasuk) = YEAR(CURRENT_DATE()) AND MONTH(dTglMasuk) = MONTH(CURRENT_DATE()) ";
$sql .= "  GROUP BY DATE_FORMAT(dTglMasuk,'%d') ";
$sql .= ") tamu ON tgl.cDay = tamu.dTglMasuk ";
$sql .= "WHERE tgl.cDay <= DATE_FORMAT(LAST_DAY(CONCAT(YEAR(CURRENT_DATE()),'-',MONTH(CURRENT_DATE()),'-','1')),'%d') ";
$rs = $conn->Execute($sql);
$trf_data1  = "var data1 = [ ";
$trf_data2  = "var data2 = [ ";
$bykdata = $rs->RecordCount();
$idx = 1;
while(!$rs->EOF){
  $sep = $idx<$bykdata ? "," : "";
  $trf_data1 .= "[".$rs->fields["cDay"].",".$rs->fields["jml"]."]".$sep;
  $trf_data2 .= "[".$rs->fields["cDay"].",".$rs->fields["jml"]."]".$sep;
  $idx++;
  $rs->MoveNext();
}
$trf_data1 .= "];";
$trf_data2 .= "];";
$rs->Close();


$src = 
"
		function chartMonth() { 
			$trf_data1
			$trf_data2
			
			var plot = $.plot($(\"#chart-dash\"), [{
				data: data2,
				label: \"Pageviews\",
				bars: {
					show: true,
					fill: true,
					barWidth: 0.4,
					align: \"center\",
					lineWidth: 13
				}
			}, {
				data: data1,
				label: \"Visits\",
				lines: {
					show: true,
					lineWidth: 2
				},
				points: {
					show: true,
					lineWidth: 2,
					fill: true
				},
				shadowSize: 0
			}, {
				data: data1,
				label: \"Visits\",
				lines: {
					show: true,
					lineWidth: 1,
					fill: true,
                    fillColor: {
                        colors: [{
                                opacity: 0.05
                            }, {
                                opacity: 0.01
                            }
                        ]
                    }
				},
				points: {
					show: true,
					lineWidth: 0.5,
					fill: true
				},
				shadowSize: 0
			}], {
				grid: {
					hoverable: true,
					clickable: true,
					tickColor: \"#f7f7f7\",
					borderWidth: 0,
					labelMargin: 10,
					margin: {
						top: 0,
						left: 5,
						bottom: 0,
						right: 0
					}
				},
				legend: {
					show: false
				},
				colors: [\"rgba(109,173,189,0.5)\", \"#70AFC4\", \"#DB5E8C\"],
				
				xaxis: {
					ticks: 5,
					tickDecimals: 0,
					tickColor: \"#fff\"
				},
				yaxis: {
					ticks: 3,
					tickDecimals: 0
				},
			});
			function showTooltip(x, y, contents) {
                    $('<div id=\"tooltip\">' + contents + '</div>').css({
                            position: 'absolute',
                            display: 'none',
                            top: y + 5,
                            left: x + 15,
                            border: '1px solid #333',
                            padding: '4px',
                            color: '#fff',
                            'border-radius': '3px',
                            'background-color': '#333',
                            opacity: 0.80
                        }).appendTo(\"body\").fadeIn(200);
                }
			var previousPoint = null;
			$(\"#chart-dash\").bind(\"plothover\", function (event, pos, item) {
				$(\"#x\").text(pos.x.toFixed(2));
				$(\"#y\").text(pos.y.toFixed(2));
				if (item) {
					if (previousPoint != item.dataIndex) {
						previousPoint = item.dataIndex;
						$(\"#tooltip\").remove();
						var x = item.datapoint[0].toFixed(2),
							y = item.datapoint[1].toFixed(2);
						showTooltip(item.pageX, item.pageY,
							item.series.label + \" of \" + x + \" = \" + y);
					}
				} else {
					$(\"#tooltip\").remove();
					previousPoint = null;
				}
			});
		}

		//Revenue chart
		function chart_revenue() {
		    $rev_chart

			var chartColor = $(this).parent().parent().css(\"color\");
			
			var plot = $.plot($(\"#chart-revenue\"),
				   [ { data: likes} ], {
					   series: {
						   label: \"Revenue\",
						   lines: { 
								show: true,
								lineWidth: 3, 
								fill: false
						   },
						   points: { 
								show: true, 
								lineWidth: 3,
								fill: true,
								fillColor: chartColor 
						   },	
						   shadowSize: 0
					   },
					   grid: { hoverable: true, 
							   clickable: true, 
							   tickColor: \"rgba(255,255,255,.15)\",
							   borderColor: \"rgba(255,255,255,0)\"
							 },
					   colors: [\"#fff\"],
					   xaxis: {
							font: {
								color: \"#fff\"
							},
							ticks:6, 
							tickDecimals: 0, 
							tickColor: chartColor,
					   },
					   yaxis: {
							font: {
								color: \"#fff\"
							},
							ticks:4, 
							tickDecimals: 0,
							autoscaleMargin: 0.000001
					   },
					   legend: {
							show: false
					   }
					 });

			function showTooltip(x, y, contents) {
				$('<div id=\"tooltip\">' + contents + '</div>').css( {
					position: 'absolute',
					display: 'none',
					top: y + 5,
					left: x + 5,
					border: '1px solid #fdd',
					padding: '2px',
					'background-color': '#dfeffc',
					opacity: 0.80
				}).appendTo(\"body\").fadeIn(200);
			}

			var previousPoint = null;
			$(\"#chart-revenue\").bind(\"plothover\", function (event, pos, item) {
				$(\"#x\").text(pos.x.toFixed(2));
				$(\"#y\").text(pos.y.toFixed(2));

					if (item) {
						if (previousPoint != item.dataIndex) {
							previousPoint = item.dataIndex;

							$(\"#tooltip\").remove();
							var x = item.datapoint[0].toFixed(2),
								y = item.datapoint[1].toFixed(2);

							showTooltip(item.pageX, item.pageY,
										item.series.label + \" on \" + x + \" = \" + y);
						}
					}
					else {
						$(\"#tooltip\").remove();
						previousPoint = null;
					}
			});
		}

";

echo $src;
?>