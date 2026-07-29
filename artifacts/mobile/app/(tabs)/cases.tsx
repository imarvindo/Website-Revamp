import React from 'react';
import {
  ActivityIndicator,
  FlatList,
  Platform,
  Pressable,
  StyleSheet,
  Text,
  View,
} from 'react-native';
import { useColors } from '@/hooks/useColors';
import { useListCaseStudies } from '@workspace/api-client-react';
import type { CaseStudy } from '@workspace/api-client-react';
import { Feather } from '@expo/vector-icons';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import * as Haptics from 'expo-haptics';

function MetricPill({ label, value }: { label: string; value: string }) {
  const colors = useColors();
  return (
    <View style={[styles.metricPill, { backgroundColor: colors.secondary }]}>
      <Text style={[styles.metricValue, { color: colors.accent }]}>{value}</Text>
      <Text style={[styles.metricLabel, { color: colors.mutedForeground }]}>{label}</Text>
    </View>
  );
}

function CaseCard({ item }: { item: CaseStudy }) {
  const colors = useColors();
  const [expanded, setExpanded] = React.useState(false);

  const handlePress = () => {
    Haptics.impactAsync(Haptics.ImpactFeedbackStyle.Light);
    setExpanded((v) => !v);
  };

  return (
    <Pressable
      style={({ pressed }) => [
        styles.card,
        {
          backgroundColor: colors.card,
          borderColor: colors.border,
          opacity: pressed ? 0.9 : 1,
        },
      ]}
      onPress={handlePress}
    >
      {/* Top row */}
      <View style={styles.cardTop}>
        <View style={styles.clientInfo}>
          <Text style={[styles.clientName, { color: colors.foreground }]}>
            {item.clientName}
          </Text>
          <View style={styles.tags}>
            <View style={[styles.tag, { backgroundColor: colors.secondary }]}>
              <Text style={[styles.tagText, { color: colors.mutedForeground }]}>
                {item.industry}
              </Text>
            </View>
            <View style={[styles.tag, { backgroundColor: '#1A2540' }]}>
              <Text style={[styles.tagText, { color: colors.primary }]}>
                {item.service}
              </Text>
            </View>
          </View>
        </View>
        <Feather
          name={expanded ? 'chevron-up' : 'chevron-down'}
          size={18}
          color={colors.mutedForeground}
        />
      </View>

      {/* Key metrics (always visible) */}
      <View style={styles.metricsRow}>
        {item.results.slice(0, 3).map((m, i) => (
          <MetricPill key={i} label={m.label} value={m.value} />
        ))}
      </View>

      {/* Expanded: challenge + solution */}
      {expanded && (
        <View style={[styles.expandedContent, { borderTopColor: colors.border }]}>
          <View style={styles.expandedSection}>
            <Text style={[styles.expandedLabel, { color: colors.mutedForeground }]}>
              CHALLENGE
            </Text>
            <Text style={[styles.expandedText, { color: colors.foreground }]}>
              {item.challenge}
            </Text>
          </View>
          <View style={styles.expandedSection}>
            <Text style={[styles.expandedLabel, { color: colors.mutedForeground }]}>
              SOLUTION
            </Text>
            <Text style={[styles.expandedText, { color: colors.foreground }]}>
              {item.solution}
            </Text>
          </View>
        </View>
      )}
    </Pressable>
  );
}

export default function CasesScreen() {
  const colors = useColors();
  const insets = useSafeAreaInsets();
  const topPad = Platform.OS === 'web' ? 67 : insets.top;
  const bottomPad = Platform.OS === 'web' ? 34 : insets.bottom + 60;

  const { data: cases, isLoading, isError, refetch } = useListCaseStudies({});

  return (
    <View style={[styles.container, { backgroundColor: colors.background }]}>
      <View style={[styles.header, { paddingTop: topPad + 12, borderBottomColor: colors.border }]}>
        <Text style={[styles.headerTitle, { color: colors.foreground }]}>Results</Text>
        <Text style={[styles.headerSubtitle, { color: colors.mutedForeground }]}>
          Real results for real businesses
        </Text>
      </View>

      {isLoading ? (
        <ActivityIndicator color={colors.primary} style={styles.loader} />
      ) : isError ? (
        <View style={styles.errorState}>
          <Feather name="alert-circle" size={32} color={colors.destructive} />
          <Text style={[styles.errorText, { color: colors.mutedForeground }]}>
            Failed to load case studies
          </Text>
          <Pressable
            style={[styles.retryBtn, { borderColor: colors.primary }]}
            onPress={() => refetch()}
          >
            <Text style={[styles.retryText, { color: colors.primary }]}>Retry</Text>
          </Pressable>
        </View>
      ) : (
        <FlatList
          data={cases ?? []}
          keyExtractor={(item) => item.slug}
          renderItem={({ item }) => <CaseCard item={item} />}
          contentContainerStyle={{
            paddingHorizontal: 16,
            paddingTop: 16,
            paddingBottom: bottomPad,
            gap: 12,
          }}
          showsVerticalScrollIndicator={false}
          scrollEnabled={!!(cases && cases.length > 0)}
          ListEmptyComponent={
            <View style={styles.emptyState}>
              <Feather name="inbox" size={32} color={colors.mutedForeground} />
              <Text style={[styles.emptyText, { color: colors.mutedForeground }]}>
                No case studies yet
              </Text>
            </View>
          }
        />
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1 },
  header: {
    paddingHorizontal: 20,
    paddingBottom: 16,
    borderBottomWidth: 1,
  },
  headerTitle: { fontSize: 28, fontFamily: 'Inter_700Bold', marginBottom: 2 },
  headerSubtitle: { fontSize: 14, fontFamily: 'Inter_400Regular' },
  loader: { marginTop: 60 },
  card: {
    padding: 16,
    borderRadius: 12,
    borderWidth: 1,
    gap: 12,
  },
  cardTop: {
    flexDirection: 'row',
    alignItems: 'flex-start',
    justifyContent: 'space-between',
  },
  clientInfo: { flex: 1, gap: 6 },
  clientName: { fontSize: 16, fontFamily: 'Inter_700Bold' },
  tags: { flexDirection: 'row', flexWrap: 'wrap', gap: 6 },
  tag: {
    paddingHorizontal: 8,
    paddingVertical: 3,
    borderRadius: 6,
  },
  tagText: { fontSize: 11, fontFamily: 'Inter_500Medium' },
  metricsRow: { flexDirection: 'row', flexWrap: 'wrap', gap: 8 },
  metricPill: {
    paddingHorizontal: 12,
    paddingVertical: 8,
    borderRadius: 8,
    alignItems: 'center',
    minWidth: 80,
  },
  metricValue: { fontSize: 18, fontFamily: 'Inter_700Bold' },
  metricLabel: { fontSize: 11, fontFamily: 'Inter_400Regular', marginTop: 2 },
  expandedContent: {
    borderTopWidth: 1,
    paddingTop: 12,
    gap: 12,
  },
  expandedSection: { gap: 4 },
  expandedLabel: { fontSize: 10, fontFamily: 'Inter_600SemiBold', letterSpacing: 0.8 },
  expandedText: { fontSize: 13, fontFamily: 'Inter_400Regular', lineHeight: 19 },
  errorState: { alignItems: 'center', paddingTop: 60, gap: 12 },
  errorText: { fontSize: 14, fontFamily: 'Inter_400Regular' },
  retryBtn: {
    paddingVertical: 10,
    paddingHorizontal: 24,
    borderRadius: 8,
    borderWidth: 1.5,
    marginTop: 4,
  },
  retryText: { fontSize: 14, fontFamily: 'Inter_600SemiBold' },
  emptyState: { alignItems: 'center', paddingTop: 60, gap: 8 },
  emptyText: { fontSize: 14, fontFamily: 'Inter_400Regular' },
});
